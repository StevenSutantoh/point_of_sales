<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Barang;
use App\Models\Supplier;
use Validator;

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
            $list_pembelian = Pembelian::where('nama', 'LIKE', "%$keyword%")
                ->orWhere('tanggal', 'LIKE', "%$keyword%")
                ->orWhere('nama_barang', 'LIKE', "%$keyword%")
                ->orWhere('kuantitas', 'LIKE', "%$keyword%")
                ->orWhere('harga_jual', 'LIKE', "%$keyword%")
                ->orWhere('metode_pembayaran', 'LIKE', "%$keyword%")
                ->join('supplier as s','s.id_supplier','pembelian.id_supplier')
                ->latest()->paginate($perPage);
            } else {
                $list_pembelian = Pembelian::join('supplier as s','s.id_supplier','pembelian.id_supplier')
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
        $data['nama_barang'] = Barang::where('id_barang',$data['id_barang'])->first()->nama_barang;
        $data['total_pembelian'] = $data['kuantitas'] * $data['harga_beli'];
        
        $data_new = array(
            'id_barang' => $data['id_barang'],
            'id_supplier' => $data['id_supplier'],
            'tanggal' => $data['tanggal'],
            'nama_barang' => $data['nama_barang'],
            'kuantitas' => $data['kuantitas'],
            'harga_beli' => $data['harga_beli'],
            'total_pembelian' => $data['total_pembelian'],
            'metode_pembayaran' => $data['metode_pembayaran']
        );
        Pembelian::create($data_new);
    
        return redirect()->route('pembelian.index')
                        ->with('success','Pembelian baru telah dicatat');
    }
}
