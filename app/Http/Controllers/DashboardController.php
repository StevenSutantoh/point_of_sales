<?php

namespace App\Http\Controllers;

use App\Models\DetailPembelian;
use App\Models\DetailPenjualan;
use App\Models\Pembelian;
use App\Models\Pengeluaran;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('home.dashboard');
    }

    public function detail($type){
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        if($type == 'purchase'){
            $total = Pembelian::all();
            $list = Pembelian::join('supplier as s','s.id_supplier','pembelian.id_supplier')->select('pembelian.*','s.nama_supplier')->skip(($page - 1) * 10)->take(10)->get();
            foreach ($list as $item) {
                $item['details'] = DetailPembelian::where('id_pembelian',$item->id_pembelian)
                                    ->join('barang as b','b.id_barang','detail_pembelians.id_barang')
                                    ->select('detail_pembelians.*','b.nama_barang')
                                    ->get();
            }
        }
        else if($type == 'sales'){
            $total = Penjualan::all();
            $list = Penjualan::join('customer as c','c.id_customer','penjualan.id_customer')->select('penjualan.*','c.nama_customer')->skip(($page - 1) * 10)->take(10)->get();
            foreach ($list as $item) {
                $item['details'] = DetailPenjualan::where('id_penjualan',$item->id_penjualan)
                                    ->join('barang as b','b.id_barang','detail_penjualans.id_barang')
                                    ->select('detail_penjualans.*','b.nama_barang')
                                    ->get();
            }
        }
        else if($type == 'expense'){
            $total = Pengeluaran::all();
            $list = Pengeluaran::skip(($page - 1) * 10)->take(10)->get();
        }
        return view('report.index',compact('total','list'));
    }
}
