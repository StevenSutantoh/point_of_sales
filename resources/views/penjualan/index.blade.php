@extends('layouts.app')

@section('title','List Penjualan')

@section('css') 
  <link rel="stylesheet" href="{{asset('AdminLTE-2/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <a href="{{route('penjualan.create')}}" class="btn btn-primary">
                        Tambah Penjualan
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
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Customer</th>
                                <th>Total Penjualan</th>
                                <th>Metode Pembayaran</th>
                                <th>Status Pembayaran</th>
                                <th>Invoice dibuat</th>
                                <th>Aksi Detail</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($list_penjualan as $item)
                                    <tr>
                                        <td>{{$item->id_penjualan}}</td>
                                        <td>{{$item->tanggal}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>Rp. {{number_format($item->total_penjualan)}}</td>
                                        <td class="text-bold">{{strtoupper($item->metode_pembayaran)}}</td>
                                        <td class="text-bold @if($item->status_pembayaran == 'approve') bg-success @else bg-warning @endif">{{$item->status_pembayaran}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('penjualan.show',$item->id_penjualan) }}">Lihat</a>
                                            <a class="btn btn-warning" href="{{ route('penjualan.edit',$item->id_penjualan)}}">Edit</a>
                                        </td>
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