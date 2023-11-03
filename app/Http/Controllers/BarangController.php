<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\DetailPembelian;
use App\Models\DetailPenjualan;

class BarangController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
         $this->middleware('permission:product-create', ['only' => ['create','store']]);
         $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $barang = Barang::where('nama_kategori', 'LIKE', "%$keyword%")
                ->orWhere('id_stok', 'LIKE', "%$keyword%")
                ->orWhere('nama_barang', 'LIKE', "%$keyword%")
                ->orWhere('merk', 'LIKE', "%$keyword%")
                ->orWhere('kuantitas', 'LIKE', "%$keyword%")
                ->orWhere('harga_jual', 'LIKE', "%$keyword%")
                ->orWhere('stok', 'LIKE', "%$keyword%")
                ->join('kategori as k','k.id_kategori','barang.id_kategori')
                ->select('barang.*','k.nama_kategori','s.nama')
                ->latest()->paginate($perPage);
            } else {
                $barang = Barang::select('barang.*','k.nama_kategori')
                            ->join('kategori as k','k.id_kategori','barang.id_kategori')
                            ->latest()
                            ->paginate($perPage);
        }
        $arr_last_price = array();
        $arr_total_price = array();
        $arr_id_exist = array();
        $arr_terjual = array();
        $arr_id_terjual = array();
        $list_beli_terakhir = 
        DetailPembelian::select('id_barang', 'id_detail_pembelian','harga_beli' , DB::raw('MAX(created_at)'))->groupBy('id_barang')->get();
        foreach ($list_beli_terakhir as $item) {
            $arr_last_price[$item->id_barang] = $item->harga_beli;
            $total_pembelian = DetailPembelian::where('id_barang',$item->id_barang)->select(DB::raw('kuantitas * harga_beli as total'))->get();
            if(count($total_pembelian) > 0){
                $total_pembelian = $total_pembelian->sum('total');
            }
            else {
                $total_pembelian = 0;
            }
            $arr_total_price[$item->id_barang] = $total_pembelian;
            array_push($arr_id_exist,$item->id_barang);
        }
        $list_jual_terakhir = DetailPenjualan::select('id_barang')->groupBy('id_barang')->get();
        foreach ($list_beli_terakhir as $item) {
            $total_penjualan = DetailPenjualan::where('id_barang',$item->id_barang)->select('kuantitas',DB::raw('kuantitas * harga_jual as total'))->get();
            if(count($total_penjualan) > 0){
                $total = $total_penjualan->sum('total');
                $jumlah_terjual = $total_penjualan->sum('kuantitas');
            }
            else {
                $total = 0;
                $jumlah_terjual = 0;
            }
            $arr_terjual[$item->id_barang] = $total;
            $arr_jlh_terjual[$item->id_barang] = $jumlah_terjual;
            array_push($arr_id_terjual,$item->id_barang);
        }
        $list_kategori = Kategori::all();

        return view('barang.index', compact('barang','list_kategori','arr_total_price','arr_last_price','arr_id_exist','arr_terjual','arr_id_terjual','arr_jlh_terjual'));
    }

    public function view_create(){
        $list_kategori = Kategori::all();
        $list_supplier = Supplier::all();
        return view('barang.create',compact('list_kategori','list_supplier'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'id_kategori' => 'required',
            'nama_barang' => 'required',
            'id_supplier' => 'required',
            'stok' => 'required',
            'merk' => 'required',
            'size' => 'required',
            'harga_jual' => 'required',
        ]);
        if ($validator->fails()) {
            // Handle the validation failure for the second field
            return redirect()->back()->with('error',$validator->errors());
        }
        try {
            Barang::create($data);
        }
        catch(Exception $e){
            $error = $e->getMessage();
            dd($error);
            return redirect()->back()->with('error',$error);
        }
        return redirect()->back()->with('success','Berhasil menambahkan barang baru');
    }

    public function view_add_size($nama){
        $list_existed = Barang::where('nama_barang',$nama)->get();
        return view('barang.add_size',compact('list_existed'));
    }

    public function add_size(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'new_size' => 'required',
            'stok' => 'required'
        ]);
        if ($validator->fails()) {
            // Handle the validation failure for the second field
            return redirect()->back()->with('error',$validator->errors());
        }
        DB::beginTransaction();
        try{
            $detail_barang = Barang::where('id_barang',$data['id_barang'])->first();
            $detail_barang['size'] = $data['new_size'];
            Barang::create([
                'id_kategori' => $detail_barang['id_kategori'],
                'nama_barang' => $detail_barang['nama_barang'],
                'id_supplier' => $detail_barang['id_supplier'],
                'stok' => $data['stok'],
                'merk' => $detail_barang['merk'],
                'size' => $data['new_size'],
                'harga_jual' => $detail_barang['harga_jual'],
            ]);
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e->getMessage);
        }
        return redirect()->back()->with('success','Berhasil menambahkan size baru');
        // Barang::
    }
    public function del_size($id_barang,$size){
        $barang = Barang::where('id_barang',$id_barang)->first();
        try{
            Barang::where('nama_barang',$barang->nama_barang)->where('size',$size)->delete();
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e->getMessage);
        }
        return redirect()->back()->with('success','Berhasil menghapus size');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
