@extends('layouts.app')

@section('title','Retur Penjualan')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Buat Return Penjualan Baru - Step 1</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="javascript:history.back()"> Kembali</a>
                </div>
            </div>
        </div>
        
        
        {!! Form::open(array('route' => 'admin.retur_sales.2nd_page','method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Customer :</strong>
                    <br/>
                    <select name="id_customer" id="id_customer" class="form-control">
                        @foreach ($list_penjualan as $item)
                            <option value="{{$item->id_customer}}">{{$item->nama_customer}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Next</button>
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