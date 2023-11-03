@extends('layouts.app')

@section('title','Retur Pembelian')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Buat Return Pembelian Baru - Step 1</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="javascript:history.back()"> Kembali</a>
                </div>
            </div>
        </div>
        
        
        {!! Form::open(array('route' => 'admin.retur_purchase.2nd_page','method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Supplier :</strong>
                    <br/>
                    <select name="id_supplier" id="id_supplier" class="form-control">
                        @foreach ($list_pembelian as $item)
                            <option value="{{$item->id_supplier}}">{{$item->nama_supplier}}</option>
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

@endsection 