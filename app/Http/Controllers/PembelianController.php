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
                  join('detail_pembelians as dp','dp.id_pembelian','pembelian.id_pembelian')
                ->join('supplier as s','s.id_supplier','dp.id_supplier')
                ->where('nama', 'LIKE', "%$keyword%")
                ->orWhere('tanggal', 'LIKE', "%$keyword%")
                ->orWhere('nama_barang', 'LIKE', "%$keyword%")
                ->orWhere('kuantitas', 'LIKE', "%$keyword%")
                ->orWhere('harga_jual', 'LIKE', "%$keyword%")
                ->orWhere('metode_pembayaran', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
            } else {
                $list_pembelian = Pembelian:: 
                              join('detail_pembelians as dp','dp.id_pembelian','pembelian.id_pembelian')
                            ->join('supplier as s','s.id_supplier','dp.id_supplier')
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
        $list_supplier = Supplier::orderBy('nama','ASC')->get()->pluck('nama', 'id_supplier');
        $list_barang = Barang::orderBy('nama_barang','ASC')->get()->pluck('nama_barang', 'id_barang');
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
                            ->join('supplier as s','dp.id_supplier','s.id_supplier')
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
        //
    }
     /**
     * Show the form for editing the specified resource.
     */
    public function add(string $id)
    {
        //
    }
}
