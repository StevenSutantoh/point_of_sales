<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Barang;
use App\Models\Customer;
use Validator;
use DB;

class PenjualanController extends Controller
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
            $list_penjualan = Penjualan::
                join('customer as c','c.id_customer','penjualan.id_customer')
                ->where('nama', 'LIKE', "%$keyword%")
                ->orWhere('tanggal', 'LIKE', "%$keyword%")
                ->orWhere('nama_barang', 'LIKE', "%$keyword%")
                ->orWhere('kuantitas', 'LIKE', "%$keyword%")
                ->orWhere('harga_jual', 'LIKE', "%$keyword%")
                ->orWhere('metode_pembayaran', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
            } else {
                $list_penjualan = Penjualan::
                            join('customer as c','c.id_customer','penjualan.id_customer')
                            ->latest('penjualan.created_at')
                            ->paginate($perPage);
        }

        return view('penjualan.index', compact('list_penjualan'));
    }

    public function create()
    {
        $list_customer = Customer::orderBy('nama','ASC')->get()->pluck('nama', 'id_customer');
        $list_barang = Barang::orderBy('nama_barang','ASC')->get();
        return view('penjualan.create',compact('list_customer','list_barang'));
    }

    public function secondPageCreate(Request $request){
        $data = $request->all();
        $list_id_barang = explode(',',$data['cart_list']);
        $list_barang = Barang::whereIn('id_barang',$list_id_barang)->orderBy('id_barang','ASC')->get();
        return view('penjualan.secondPage',compact('data','list_barang'));
    }

    public function store(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'id_customer' => 'required',
            'ids' => 'required',
            'tanggal' => 'required',
            'kuantitas' => 'required',
            'harga_jual' => 'required',
            'metode_pembayaran' => 'required',
            'status_pembayaran' => 'required',
        ]);
        if ($validator->fails()) {
            // Handle the validation failure for the second field
            return route('penjualan.create')->with('error',$validator->errors());
        }
        DB::beginTransaction();
        try {
            $total = 0;
            for ($i=0; $i < count($data['ids']) ; $i++) { 
              $total += $data['kuantitas'][$i] * $data['harga_jual'][$i];
            }
            $penjualan = Penjualan::create([
                'tanggal' => $data['tanggal'],
                'id_customer' => $data['id_customer'],
                'total_penjualan' => $total,
                'metode_pembayaran' => $data['metode_pembayaran'],
                'status_pembayaran' => $data['status_pembayaran']
            ]);
            // $arr = array();
            for ($i=0; $i < count($data['ids']) ; $i++) { 
                $item['id_penjualan'] = $penjualan->id_penjualan;
                $item['id_barang'] = $data['ids'][$i];
                $item['kuantitas'] = $data['kuantitas'][$i];
                $item['harga_jual'] = $data['harga_jual'][$i];
                // array_push($arr,$item);
                DetailPenjualan::create($item);
            }
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            return route('penjualan.create')->with('error',$e->getMessage());
        }
        return redirect()->route('penjualan.index');
    }

    public function show($id){

    }
}
