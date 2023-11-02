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
        $list_kategori = Kategori::all();

        return view('barang.index', compact('barang','list_kategori'));
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
                'stok' => $detail_barang['stok'],
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
