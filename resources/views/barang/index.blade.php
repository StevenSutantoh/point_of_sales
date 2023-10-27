@extends('layouts.app')

@section('title','List Barang')

@section('css') 
  <link rel="stylesheet" href="{{asset('AdminLTE-2/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <a href="{{route('admin.view_tambah_barang')}}" class="btn btn-primary">
                        Tambah Barang
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
                                <th>Kategori</th>
                                <th>Stock</th>
                                <th>Merk</th>
                                <th>Harga Beli</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($barang as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$item->nama_barang}}</td>
                                        <td>{{$item->id_supplier}}</td>
                                        <td>{{$item->nama_kategori}}</td>
                                        <td>{{$item->stok}}</td>
                                        <td>{{$item->merk}}</td>
                                        <td>{{$item->harga_jual}}</td>
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