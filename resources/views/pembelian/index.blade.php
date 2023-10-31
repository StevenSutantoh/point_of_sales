@extends('layouts.app')

@section('title','List Pembelian')

@section('css') 
  <link rel="stylesheet" href="{{asset('AdminLTE-2/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <a href="{{route('pembelian.create')}}" class="btn btn-primary">
                        Tambah Pembelian
                    </a>
                </div>
                <div class="row">
                    <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Data Table With Full Features</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <table id="table_barang" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Supplier</th>
                                <th>Tanggal</th>
                                <th>Kuantitas</th>
                                <th>Total Pembelian</th>
                                <th>Metode Pembayaran</th>
                                <th>Invoice dibuat</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($list_pembelian as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$item->nama_barang}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->tanggal}}</td>
                                        <td>{{$item->kuantitas}}</td>
                                        <td>{{$item->total_pembelian}}</td>
                                        <td>{{$item->metode_pembayaran}}</td>
                                        <td>{{$item->created_at}}</td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
    <script>
        $(function () {
            $('#table_barang').DataTable()
        })
    </script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@endsection