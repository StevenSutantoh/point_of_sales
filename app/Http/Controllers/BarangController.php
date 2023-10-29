<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
            $barang = Barang::where('id_kategori', 'LIKE', "%$keyword%")
                ->orWhere('id_stok', 'LIKE', "%$keyword%")
                ->orWhere('nama_barang', 'LIKE', "%$keyword%")
                ->orWhere('merk', 'LIKE', "%$keyword%")
                ->orWhere('kuantitas', 'LIKE', "%$keyword%")
                ->orWhere('harga_jual', 'LIKE', "%$keyword%")
                ->orWhere('stok', 'LIKE', "%$keyword%")
                ->join('kategori as k','k.id_kategori','barang.id_kategori')
                ->select('barang.*','k.nama_kategori')
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
        return view('barang.create',compact('list_kategori'));
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
