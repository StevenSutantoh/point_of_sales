@extends('layouts.app')

@section('title','Edit Detail Penjualan')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit detail penjualan</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="javascript:history.back()"> Kembali</a>
                </div>
            </div>
        </div>
        
        
        {!! Form::open(array('route' => 'admin.penjualan.commit_edit_change','method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Barang :</strong>
                    <br/>
                    <input type="hidden" name="id_detail_penjualan" value="{{$detail_penjualan->id_detail_penjualan}}">
                    <input type="hidden" name="id_barang" value="{{$barang->id_barang}}">
                    <input type="hidden" name="id_penjualan" value="{{$penjualan->id_penjualan}}">
                    <input type="text" class="form-control" name="" id="" value="{{$barang->nama_barang}}" disabled>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah :</strong>
                    <br/>
                    {!! Form::number('kuantitas', $detail_penjualan->kuantitas , ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Harga Jual :</strong>
                    <br/>
                    {!! Form::number('harga_jual', $detail_penjualan->harga_jual , ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</section>
@endsection

@section('js')
    <script>
        var items = [];
        var items_id = [];
        $('#barang').on('change', function() {
            var arr = (this.value).split("#");
            if(!items_id.includes(arr[0])) {
                items.push(arr[1])
                items_id.push(arr[0])
                $("#cart_barang").append("<li>"+arr[1]+"<br>")
                $("#cart_list").val(items_id);
            }
        });
    </script>
@endsection 