<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturPembelian;
use App\Models\ReturPenjualan;
use App\Models\Penjualan;
use App\Models\Pembelian;
use App\Models\Barang;
use App\Models\DetailPenjualan;
use App\Models\DetailPembelian;
use DB;

class ReturController extends Controller
{
    public function sales_index(){
        $list_retur_penjualan = ReturPenjualan::join('customer as c','c.id_customer','retur_penjualan.id_customer')
                                ->join('barang as b','b.id_barang','retur_penjualan.id_barang')
                                ->select('retur_penjualan.*','b.nama_barang','b.merk','b.size','c.nama_customer')
                                ->get();
        return view('retur.index_sales',compact('list_retur_penjualan'));
    }
    public function sales_create(){
        $list_penjualan = Penjualan::join('customer as c','c.id_customer','penjualan.id_customer')
                            ->select('c.id_customer','c.nama_customer')
                            ->groupBy('penjualan.id_customer')->get();
        return view('retur.first_page',compact('list_penjualan'));
    }
    public function sales_2ndPage(Request $request){
        $data = $request->all();
        $id_customer = $data['id_customer'];
        $list_penjualan_byCust = Penjualan::join('customer as c','c.id_customer','penjualan.id_customer')
                                    ->where('c.id_customer',$id_customer)->get();
        return view('retur.second_page',compact('list_penjualan_byCust'));
    }
    public function sales_3rdPage(Request $request){
        $data = $request->all();
        $id_penjualan = $data['id_penjualan'];
        $detail_penjualan = DetailPenjualan::where('id_penjualan',$id_penjualan)
                            ->join('barang as b','b.id_barang','detail_penjualans.id_barang')
                            ->select('detail_penjualans.*','b.nama_barang','b.merk','b.size')
                            ->get();
        return view('retur.third_page',compact('detail_penjualan'));
    }
    public function confirmRetur($id){
        DB::beginTransaction();
        try {
            $detail_penjualan = DetailPenjualan::where('id_detail_penjualan',$id)
                                ->join('penjualan as p','p.id_penjualan','detail_penjualans.id_penjualan')
                                ->first();
            // dd($detail_penjualan);
            Barang::where('id_barang',$detail_penjualan->id_barang)->update([
                'stok' => DB::raw('stok + '.$detail_penjualan->kuantitas)
            ]);
            Penjualan::where('id_penjualan',$detail_penjualan->id_penjualan)->update([
                'total_penjualan' => DB::raw('total_penjualan - '.($detail_penjualan->kuantitas * $detail_penjualan->harga_jual))
            ]);
            ReturPenjualan::create([
                'id_customer' => $detail_penjualan->id_customer,
                'id_barang' => $detail_penjualan->id_barang,
                'tanggal' => $detail_penjualan->tanggal,
                'kuantitas' => $detail_penjualan->kuantitas,
                'harga' => $detail_penjualan->harga,
                'total' => $detail_penjualan->harga_jual * $detail_penjualan->kuantitas,
            ]);
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Terjadi kesalahan');
        }
        $sisa_detail = DetailPenjualan::where('id_penjualan',$detail_penjualan->id_penjualan)->get();
        $detail_penjualan->delete();
        if(count($sisa_detail) > 1){
            return redirect('admin/retur_sales_index/create')->with('success','Berhasil retur barang');
        }
        else {
            Penjualan::where('id_penjualan',$detail_penjualan->id_penjualan)->delete();
            return redirect('admin/retur_sales_index');;
        }
    }


    //Purchase
    public function purchase_index(){
        $list_retur_pembelian = ReturPembelian::join('supplier as s','s.id_supplier','retur_pembelian.id_supplier')
                                ->join('barang as b','b.id_barang','retur_pembelian.id_barang')
                                ->select('retur_pembelian.*','b.nama_barang','b.merk','b.size','s.nama_supplier')
                                ->get();
        return view('retur2.index_purchase',compact('list_retur_pembelian'));
    }
    public function purchase_create(){
        $list_pembelian = Pembelian::join('supplier as s','s.id_supplier','pembelian.id_supplier')
                            ->select('s.id_supplier','s.nama_supplier')
                            ->groupBy('pembelian.id_supplier')->get();
        return view('retur2.first_page',compact('list_pembelian'));
    }
    public function purchase_2ndPage(Request $request){
        $data = $request->all();
        $id_supplier = $data['id_supplier'];
        $list_pembelian_bySup = Pembelian::join('supplier as s','s.id_supplier','pembelian.id_supplier')
                                    ->where('s.id_supplier',$id_supplier)->get();
        return view('retur2.second_page',compact('list_pembelian_bySup'));
    }
    public function purchase_3rdPage(Request $request){
        $data = $request->all();
        $id_pembelian = $data['id_pembelian'];
        $detail_pembelian = DetailPembelian::where('id_pembelian',$id_pembelian)
                            ->join('barang as b','b.id_barang','detail_pembelians.id_barang')
                            ->select('detail_pembelians.*','b.nama_barang','b.merk','b.size')
                            ->get();
        return view('retur2.third_page',compact('detail_pembelian'));
    }
    public function confirmRetur2($id){
        DB::beginTransaction();
        try {
            $detail_pembelian = DetailPembelian::where('id_detail_pembelian',$id)
                                ->join('pembelian as p','p.id_pembelian','detail_pembelians.id_pembelian')
                                ->first();
            Barang::where('id_barang',$detail_pembelian->id_barang)->update([
                'stok' => DB::raw('stok + '.$detail_pembelian->kuantitas)
            ]);
            Pembelian::where('id_pembelian',$detail_pembelian->id_pembelian)->update([
                'total_pembelian' => DB::raw('total_pembelian - '.($detail_pembelian->kuantitas * $detail_pembelian->harga_beli))
            ]);
            // dd($detail_pembelian->harga_beli * $detail_pembelian->kuantitas);
            ReturPembelian::create([
                'id_supplier' => $detail_pembelian->id_supplier,
                'id_barang' => $detail_pembelian->id_barang,
                'tanggal' => $detail_pembelian->tanggal,
                'kuantitas' => $detail_pembelian->kuantitas,
                'harga' => $detail_pembelian->harga_beli,
                'total' => $detail_pembelian->harga_beli * $detail_pembelian->kuantitas,
            ]);
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Terjadi kesalahan');
        }
        $sisa_detail = DetailPembelian::where('id_pembelian',$detail_pembelian->id_pembelian)->get();
        $detail_pembelian->delete();
        if(count($sisa_detail) > 1){
            return redirect('admin/retur_purchase_index/create')->with('success','Berhasil retur barang');
        }
        else {
            Pembelian::where('id_pembelian',$detail_pembelian->id_pembelian)->delete();
            return redirect('admin/retur_purchase_index');;
        }
    }

}
