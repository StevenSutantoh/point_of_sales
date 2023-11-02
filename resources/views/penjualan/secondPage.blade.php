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
                    <a class="btn btn-primary" href="javascript:history.back()" > Kembali</a>
                </div>
            </div>
        </div>
        
        
        {!! Form::open(array('route' => 'penjualan.store','method'=>'POST')) !!}
        <input type="hidden" name="id_customer" value="{{$data['id_customer']}}">
        <input type="hidden" name="tanggal" value="{{$data['tanggal']}}">
        <div class="row">
            <?php $i = 1;?>
            @foreach ($list_barang as $item)
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h3 class="text-bold">Item #{{$i}}</h3>                    
            </div>
                <input type="hidden" name="ids[]" value="{{$item->id_barang}}">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama Barang :</strong>
                        <br/>
                        <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{$item->nama_barang}}" disabled>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Jumlah :</strong>
                        <br/>
                        {!! Form::number('kuantitas[]', 0, ['class' => 'form-control','min' => 1,]) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Harga jual :</strong>
                        <br/>
                        {!! Form::number('harga_jual[]', 0, ['class' => 'form-control','min' => 1,]) !!}
                    </div>
                </div>
                <?php $i++;?>
            @endforeach
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Metode Pembayaran :</strong>
                    <br/>
                    {!! Form::select('metode_pembayaran', ['tunai' => 'Tunai','kredit' => 'Kredit'], null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status Pembayaran :</strong>
                    <br/>
                    {!! Form::select('status_pembayaran', ['pending' => 'Sedang Menunggu Konfirmasi','approve' => 'Telah dikonfirmasi'], null, ['class' => 'form-control']) !!}
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
        $(function () {
            $('#table_pembelian').DataTable()
        })
    </script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@endsection