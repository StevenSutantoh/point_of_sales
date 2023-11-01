@extends('layouts.app')

@section('title','Tambah Size')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Tambah Size Baru</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('admin.barang') }}"> Kembali</a>
                </div>
            </div>
        </div>
        
        
        {!! Form::open(array('route' => 'admin.confirm_add_size','method'=>'POST')) !!}
        <div class="row">
            <input type="hidden" name="id_barang" id="id_barang" class="form-control" value="{{$list_existed[0]->id_barang}}">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Barang :</strong>
                    <br/>
                    <input type="text" name="nama_barang" id="nama_barang" class="form-control" disabled value="{{$list_existed[0]->nama_barang}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Size saat ini :</strong>
                    <br/>
                    <div class="row">
                        @foreach ($list_existed as $item)
                            <div class="col-sm-2">
                               - {{$item->size}} <a href="{{route('admin.hapus_size',[$list_existed[0]->id_barang,$item->size])}}" class="text-danger"><i class="fa fa-trash"></i></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Size Baru :</strong>
                    <br/>
                    {!! Form::text('new_size', '', ['class' => 'form-control']) !!}
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