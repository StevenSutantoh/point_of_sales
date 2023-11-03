<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\DetailPembelian;
use App\Models\Barang;
use App\Models\Supplier;
use Validator;
use DB;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:sales-list|sales-create|sales-edit|sales-delete', ['only' => ['index','show']]);
         $this->middleware('permission:sales-create', ['only' => ['create','store']]);
         $this->middleware('permission:sales-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:sales-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $list_pembelian = Pembelian::
                  join('supplier as s','s.id_supplier','pembelian.id_supplier')
                ->where('nama_supplier', 'LIKE', "%$keyword%")
                ->orWhere('tanggal', 'LIKE', "%$keyword%")
                ->orWhere('nama_barang', 'LIKE', "%$keyword%")
                ->orWhere('kuantitas', 'LIKE', "%$keyword%")
                ->orWhere('harga_jual', 'LIKE', "%$keyword%")
                ->orWhere('metode_pembayaran', 'LIKE', "%$keyword%")
                ->select('pembelian.*','s.nama_supplier')
                ->latest()->paginate($perPage);
            } else {
                $list_pembelian = Pembelian:: 
                              join('supplier as s','s.id_supplier','pembelian.id_supplier')
                              ->select('pembelian.*','s.nama_supplier')
                            ->latest('pembelian.created_at')
                            ->paginate($perPage);
        }

        return view('pembelian.index', compact('list_pembelian'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_supplier = Supplier::orderBy('nama_supplier','ASC')->get()->pluck('nama_supplier', 'id_supplier');
        $list_barang = Barang::orderBy('nama_barang','ASC')->get();
        $arr = array();
        foreach($list_barang as $barang){
            $arr[$barang->id_barang] = $barang->nama_barang.' - '.$barang->merk.' ['.$barang->size.']';
        }
        $list_barang = $arr;
        return view('pembelian.create',compact('list_supplier','list_barang'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'id_barang' => 'required',
            'id_supplier' => 'required',
            'tanggal' => 'required',
            'kuantitas' => 'required',
            'harga_beli' => 'required',
            'metode_pembayaran' => 'required',
        ]);
        if ($validator->fails()) {
            // Handle the validation failure for the second field
            return redirect()->back()->with('error',$validator->errors());
        }
        DB::beginTransaction();
        try {
            $data['nama_barang'] = Barang::where('id_barang',$data['id_barang'])->first()->nama_barang;
            $data['total_pembelian'] = $data['kuantitas'] * $data['harga_beli'];
            $data_new = array(
                'tanggal' => $data['tanggal'],
                'id_supplier' => $data['id_supplier'],
                'total_pembelian' => $data['total_pembelian'],
                'metode_pembayaran' => $data['metode_pembayaran']
            );
            $pembelian = Pembelian::create($data_new);
            DetailPembelian::create([
                'id_pembelian' => $pembelian->id_pembelian,
                'id_barang' => $data['id_barang'],
                'kuantitas' => $data['kuantitas'],
                'harga_beli' => $data['harga_beli'],
            ]);
            Barang::where('id_barang',$data['id_barang'])->update([
                'stok' => DB::raw('stok + '.$data['kuantitas']),
            ]);
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            return redirect()->route('pembelian.index')->with('error',$e->getMessage());
        }
        return redirect()->route('pembelian.index')->with('success','Invoice pembelian baru telah dicatat');
    }

    public function show(string $id)
    {
        $pembelian = Pembelian::join('detail_pembelians as dp','dp.id_pembelian','pembelian.id_pembelian')
                            ->join('supplier as s','pembelian.id_supplier','s.id_supplier')
                            ->join('barang as b','b.id_barang','dp.id_barang')
                            ->where('dp.id_pembelian',$id)
                            ->get();
        return view('pembelian.show',compact('pembelian'));
    }
     /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pembelian = Pembelian::join('detail_pembelians as dp','dp.id_pembelian','pembelian.id_pembelian')
                        ->join('supplier as s','s.id_supplier','pembelian.id_supplier')
                        ->join('barang as b','b.id_barang','dp.id_barang')
                        ->where('dp.id_pembelian',$id)
                        ->get();
        return view('pembelian.edit',compact('pembelian'));
    }
     /**
     * Show the form for editing the specified resource.
     */
    public function add(string $id)
    {
        $pembelian = Pembelian::join('detail_pembelians as dp','dp.id_pembelian','pembelian.id_pembelian')
                        ->join('supplier as s','s.id_supplier','pembelian.id_supplier')
                        ->join('barang as b','b.id_barang','dp.id_barang')
                        ->where('dp.id_pembelian',$id)->get();
        $list_barang = Barang::orderBy('nama_barang','ASC')->get();
        $arr = array(); 
        foreach($list_barang as $barang){
            $arr[$barang->id_barang] = $barang->nama_barang.' - '.$barang->merk.' ['.$barang->size.']';
        }
        $list_barang = $arr;
        return view('pembelian.add_item',compact('list_barang','pembelian'));
    }
    public function add_item(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'id_pembelian' => 'required',
            'id_barang' => 'required',
            'kuantitas' => 'required',
            'harga_beli' => 'required',
        ]);
        DetailPembelian::create($data);
        Pembelian::where('id_pembelian',$data['id_pembelian'])->update([
            'total_pembelian' => DB::raw('total_pembelian + '.($data['kuantitas'] * $data['harga_beli']))
        ]);
        Barang::where('id_barang',$data['id_barang'])->update([
            'stok' => DB::raw('stok + '.$data['kuantitas']),
        ]);
        return redirect()->back()->with('success','Pembelian berhasil ditambah');
    }

    public function del_item($id_detail){
        try {
            $detail_pembelian = DetailPembelian::where('id_detail_pembelian',$id_detail)->first();
            DetailPembelian::where('id_detail_pembelian',$id_detail)->delete();
            Pembelian::where('id_pembelian',$detail_pembelian['id_pembelian'])->update([
                'total_pembelian' => DB::raw('total_pembelian - '.($detail_pembelian['kuantitas'] * $detail_pembelian['harga_beli']))
            ]);
            Barang::where('id_barang',$detail_pembelian['id_barang'])->update([
                'stok' => DB::raw('stok - '.$detail_pembelian['kuantitas']),
            ]);
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error',$e->getMessage);
        }
        return redirect()->back()->with('success','Berhasil menghapus item pembelian');
    }
}
