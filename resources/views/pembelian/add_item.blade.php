@extends('layouts.app')

@section('title','Detail Pembelian')

@section('css') 
  <link rel="stylesheet" href="{{asset('AdminLTE-2/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> Pembelian ID : #{{$pembelian[0]->id_pembelian}}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('pembelian.index') }}"> Kembali</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Tanggal :</strong>
                    {{ $pembelian[0]->tanggal }}
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Metode Pembayaran :
                    {{ strtoupper($pembelian[0]->metode_pembayaran) }}
                    </strong>
                </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Tercatat :</strong>
                    {{ $pembelian[0]->created_at }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="box">
                <div class="box-body">
                  <table id="table_pembelian" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Supplier</th>
                        <th>Barang</th>
                        <th>Kuantitas</th>
                        <th>Harga Beli</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelian as $item)
                            <tr>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->nama_barang}}</td>
                                <td>{{$item->kuantitas}}</td>
                                <td>Rp. {{number_format($item->harga_beli)}}</td>
                                <td>Rp. {{number_format($item->kuantitas * $item->harga_beli)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th colspan="4">
                            Total : Rp. {{number_format($pembelian[0]->total_pembelian)}}
                        </th>
                    </tfoot>
                  </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="box" style="padding : 15px 25px;">
                <div class="card-header">
                    <h3>Penambahan Item</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                    {!! Form::open(array('route' => 'admin.pembelian.add_item','method'=>'POST')) !!}
                    <div class="row">
                        <input type="hidden" name="id_pembelian" value="{{$pembelian[0]->id_pembelian}}">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nama Barang :</strong> 
                                <br/>
                                {!! Form::select('id_barang', $list_barang, null, ['class' => 'form-control']) !!}
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
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
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
            $('#table_pembelian').DataTable({
                "searching" : false,
                "lengthChange" : false
            })
        })
    </script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@endsection