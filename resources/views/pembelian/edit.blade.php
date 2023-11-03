@extends('layouts.app')

@section('title','Edit Detail Pembelian')

@section('css') 
  <link rel="stylesheet" href="{{asset('AdminLTE-2/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> Pembelian ID : #{{$pembelian[0]->id_pembelian}}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('pembelian.index') }}"> Kembali</a>
                </div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Tanggal :</strong>
                    {{ $pembelian[0]->tanggal }}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Total pembelian :</strong>
                    Rp. {{ number_format($pembelian[0]->total_pembelian) }}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>
                        Metode Pembayaran :
                        {{ strtoupper($pembelian[0]->metode_pembayaran) }}
                    </strong>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Tercatat :</strong>
                    {{ $pembelian[0]->created_at }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="box">
                <div class="box-body">
                  <table id="table_pembelian" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Supplier</th>
                        <th>Barang</th>
                        <th>Kuantitas</th>
                        <th>Harga Beli</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelian as $item)
                            <tr>
                                <td>{{$item->nama_supplier}}</td>
                                <td>{{$item->nama_barang}}</td>
                                <td>{{$item->kuantitas}}</td>
                                <td>Rp. {{number_format($item->harga_beli)}}</td>
                                <td>Rp. {{number_format($item->kuantitas * $item->harga_beli)}}</td>
                                <td><a href="{{route('admin.pembelian.hapus_detail',$item->id_detail_pembelian)}}" class="btn btn-danger">Hapus Item</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
    <script>
        $(function () {
            $('#table_pembelian').DataTable([
                "searching" : false,
                "lengthChange" : false
            ])
        })
    </script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@endsection