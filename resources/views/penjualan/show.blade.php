@extends('layouts.app')

@section('title','Detail Penjualan')

@section('css') 
  <link rel="stylesheet" href="{{asset('AdminLTE-2/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> Penjualan ID : #{{$penjualan[0]->id_penjualan}}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('penjualan.index') }}"> Kembali</a>
                </div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Nama Customer :</strong>
                    {{ $penjualan[0]->nama }}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Tanggal :</strong>
                    {{ $penjualan[0]->tanggal }}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Total penjualan :</strong>
                    Rp. {{ number_format($penjualan[0]->total_penjualan) }}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Metode Pembayaran :
                        {{ strtoupper($penjualan[0]->metode_pembayaran) }}
                    </strong>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Status Pembayaran :
                        {{ strtoupper($penjualan[0]->status_pembayaran) }}
                    </strong>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Tercatat :</strong>
                    {{ $penjualan[0]->created_at }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="box">
                <div class="box-body">
                  <table id="table_penjualan" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Kuantitas</th>
                        <th>Harga Jual</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualan as $item)
                            <tr>
                                <td>{{$item->nama_barang}}</td>
                                <td>{{$item->kuantitas}}</td>
                                <td>Rp. {{number_format($item->harga_jual)}}</td>
                                <td>Rp. {{number_format($item->kuantitas * $item->harga_jual)}}</td>
                                <td>
                                    <a href="{{route('admin.penjualan.edit_item',$item->id_detail_penjualan)}}" class="btn btn-warning">Edit</a>
                                    <a href="{{route('admin.penjualan.destroy_item',$item->id_detail_penjualan)}}" class="btn btn-danger">Hapus</a>
                                </td>
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
            $('#table_penjualan').DataTable([
                'lengthChange' : false,
                'searching' : false
            ]);
        })
    </script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@endsection