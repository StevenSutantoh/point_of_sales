@extends('layouts.app')

@section('title','Detail Pembelian')

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
                    <a class="btn btn-success" href="{{ route('admin.pembelian.add',$pembelian[0]->id_pembelian) }}"> Tambah Item</a>
                    <a class="btn btn-primary" href="{{ route('pembelian.index') }}"> Kembali</a>
                </div>
            </div>
        </div>
        
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal :</strong>
                    {{ $pembelian[0]->tanggal }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Total pembelian :</strong>
                    {{ $pembelian[0]->total_pembelian }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Metode Pembayaran :</strong>
                    {{ $pembelian[0]->metode_pembayaran }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
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
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelian as $item)
                            <tr>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->nama_barang}}</td>
                                <td>{{$item->kuantitas}}</td>
                                <td>Rp. {{number_format($item->harga_beli)}}</td>
                                <td>Rp. {{number_format($item->kuantitas * $item->harga_beli)}}</td>
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
            $('#table_pembelian').DataTable()
        })
    </script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@endsection