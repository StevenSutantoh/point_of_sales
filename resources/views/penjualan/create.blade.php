@extends('layouts.app')

@section('title','Penjualan Baru')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Buat Penjualan Baru</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('penjualan.index') }}"> Kembali</a>
                </div>
            </div>
        </div>
        
        
        {!! Form::open(array('route' => 'admin.penjualan.next','method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Customer :</strong>
                    <br/>
                    {!! Form::select('id_customer', $list_customer, null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal :</strong>
                    <br/>
                    {!! Form::date('tanggal', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <p>List Barang yang akan dibeli : </p>
                    <ol id="cart_barang"></ol>
                    <input type="hidden" name="cart_list" id="cart_list">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Barang :</strong>
                    <br/>
                    <select id="barang" class="form-control">
                        <option value="0">--- Pilih Barang (Dapat lebih dari 1) ---</option>
                        @foreach ($list_barang as $item)
                            <option value="{{$item->id_barang}}#{{$item->nama_barang}} - Size:{{$item->size}} - Merk:{{$item->merk}}">{{$item->nama_barang}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Pembelian :</strong>
                    <br/>
                    {!! Form::date('tanggal', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah :</strong>
                    <br/>
                    {!! Form::number('kuantitas', 0, ['class' => 'form-control','min' => 1,]) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Harga :</strong>
                    <br/>
                    {!! Form::number('harga_beli', 0, ['class' => 'form-control','min' => 1,]) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Metode Pembayaran :</strong>
                    <br/>
                    {!! Form::select('metode_pembayaran', ['tunai' => 'Tunai','kredit' => 'Kredit'], null, ['class' => 'form-control']) !!}
                </div>
            </div> --}}
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