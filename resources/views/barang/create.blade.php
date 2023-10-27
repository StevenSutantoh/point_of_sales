@extends('layouts.app')

@section('title','Barang Baru')

@section('css')
    <link rel="stylesheet" href="{{asset('AdminLTE-2/bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
<div class="container">
    <div class="box box-default" data-select2-id="14">
        <div class="box-header with-border">
            <h3 class="box-title">Form Penambahan Barang Baru</h3>
            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        
        <div class="box-body" data-select2-id="13">
            <form action="{{route('admin.tambah_barang_baru')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" placeholder="Masukkan nama barang" name="nama_barang">
                        </div>
                        <div class="form-group">
                            <label>Supplier</label>
                            <select class="form-control" style="width: 100%;" name="id_supplier" id="id_supplier">
                                <option selected="selected" value="0">Pilih Supplier Barang</option>
                                <option value="1">JayaPura</option>
                                <option value="2">Karawaci</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" style="width: 100%;" name="id_kategori" id="id_kategori">
                                <option selected="selected" value="0">Pilih Kategori Barang</option>
                                @foreach ($list_kategori as $item)
                                    <option value="{{$item->id_kategori}}">{{$item->nama_kategori}}</option>                        
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stock Awal</label>
                            <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan stock awal" min="0">
                        </div>
                        <div class="form-group">
                            <label for="merk">Merk</label>
                            <input type="text" class="form-control" id="merk" name="merk" placeholder="Masukkan Merk / Brand">
                        </div>
                        <div class="form-group">
                            <label for="size">Size</label>
                            <input type="text" class="form-control" id="size" name="size" placeholder="Masukkan Size Barang">
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Beli (dari Supplier)</label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual" placeholder="Masukkan Harga Jual">
                        </div>
                        <button class="btn btn-success">Submit Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{asset('AdminLTE-2/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('AdminLTE-2/plugins/input-mask/jquery.inputmask.js')}}"></script>
@endsection