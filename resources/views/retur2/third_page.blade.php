@extends('layouts.app')

@section('title','Retur Pembelian')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Buat Return Pembelian Baru - Step 3</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="javascript:history.back()"> Kembali</a>
                </div>
            </div>
        </div>
        
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Merk</th>
                    <th>Size</th>
                    <th>Kuantitas</th>
                    <th>Harga Beli</th>  
                    <th>Aksi</th>                  
                </tr>
            </thead>
            <tbody>
                @foreach ($detail_pembelian as $item)
                    <tr>
                        <td>{{$item->nama_barang}}</td>
                        <td>{{$item->merk}}</td>         
                        <td>{{$item->size}}</td>         
                        <td>{{$item->kuantitas}}</td>         
                        <td>{{$item->harga_beli}}</td>       
                        <td>
                            <a href="#" onclick="YNConfirm({{$item->id_detail_pembelian}})" class="btn btn-danger">
                                Retur Item
                            </a>
                        </td>  
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection

@section('js')
    <script>
        function YNConfirm(id_penjualan){
            var id = id_penjualan;
            if (window.confirm('Yakin untuk meretur barang ini ?'))
            {
            window.location.href = '{{URL::to("")}}'+'/admin/retur_purchase/confirmRetur2/'+id;
            }
        }
    </script>
@endsection 