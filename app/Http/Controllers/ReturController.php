<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturPenbelian;
use App\Models\ReturPenjualan;
use App\Models\Penjualan;
use App\Models\Barang;
use App\Models\DetailPenjualan;
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
    public function purchase_index(){
        
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
                            ->get();
        return view('retur.third_page',compact('detail_penjualan'));
    }
    public function confirmRetur($id){
        DB::beginTransaction();
        try {
            $detail_penjualan = DetailPenjualan::where('id_detail_penjualan',$id)
                                ->join('penjualan as p','p.id_penjualan','detail_penjualans.id_penjualan')
                                ->first();
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
}
