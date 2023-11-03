@extends('layouts.app')

@section('title','List Retur Pembelian')

@section('css') 
  <link rel="stylesheet" href="{{asset('AdminLTE-2/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <a href="{{route('admin.retur_purchase.create')}}" class="btn btn-primary">
                        Tambah Retur Pembelian
                    </a>
                </div>
                <div class="row">
                    <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Data Retur Pembelian</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <table id="table_retur_pembelian" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Supplier</th>
                                <th>Nama Barang</th>
                                <th>Merk</th>
                                <th>Size</th>
                                <th>Total</th>
                                <th>Invoice dibuat</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($list_retur_pembelian as $item)
                                    <tr>
                                        <td>{{$item->id_retur_pembelian}}</td>
                                        <td>{{$item->tanggal}}</td>
                                        <td>{{$item->nama_supplier}}</td>
                                        <td>{{$item->nama_barang}}</td>
                                        <td>{{$item->merk}}</td>
                                        <td>{{$item->size}}</td>
                                        <td>Rp. {{number_format($item->harga)}}</td>
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
            $('#table_retur_pembelian').DataTable()
        })
    </script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@endsection