@extends('layouts.app')

@section('title','List Barang')

@section('css') 
  <link rel="stylesheet" href="{{asset('AdminLTE-2/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
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
                          <h3 class="box-title">Data Table Barang</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <table id="table_barang" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Merk</th>
                                <th>Size</th>
                                <th>Harga Beli</th>
                                <th>Harga Beli Terakhir</th>
                                <th>Average Price</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($barang as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$item->nama_barang}}</td>
                                        <td>{{$item->nama_kategori}}</td>
                                        <td>{{$item->stok}}</td>
                                        <td>{{$item->merk}}</td>
                                        <td>{{$item->size}}</td>
                                        <td>Rp. {{number_format($item->harga_jual)}}</td>
                                        <td>
                                            @if (in_array($item->id_barang,$arr_id_exist))
                                            Rp. {{number_format($arr_last_price[$item->id_barang])}}
                                            @else 
                                            Belum terjual
                                            @endif
                                        </td>
                                        <td>
                                            @if (in_array($item->id_barang,$arr_id_terjual) && in_array($item->id_barang,$arr_id_exist))
                                            Rp. {{number_format(($arr_total_price[$item->id_barang] - $arr_terjual[$item->id_barang])/$item->stok)}}
                                            @else 
                                            Belum ada pembelian / penjualan
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.add_size',$item->nama_barang)}}" class="btn btn-primary">Tambah Size</a>
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