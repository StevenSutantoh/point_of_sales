<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
