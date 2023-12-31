@extends('layouts.app')

@section('title','Halaman Laporan')

@section('css') 
  <link rel="stylesheet" href="{{asset('AdminLTE-2/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <a href="{{route('admin.report_type','purchase')}}" class="btn btn-primary btn-large">Laporan Pembelian</a>
                    <a href="{{route('admin.report_type','sales')}}" class="btn btn-success btn-large">Laporan Penjualan</a>
                    <a href="{{route('admin.report_type','expense')}}" class="btn btn-info btn-large">Laporan Pengeluaran</a>
                    <a href="{{route('admin.report_type','recap')}}" class="btn btn-warning btn-large">Rekap Laporan</a>
                    <a type="button" class="pull-right btn btn-success" onclick="printOut('print_area')" >Cetak Laporan</a>
                </div>
            </div>
        </div>
        <div class="row">
            @include ('report.detail')
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
    <script>
        function printOut(id) {
            var printContents = document.getElementById(id).innerHTML;
            var originalContents = document.body.innerHTML;
        
            document.body.innerHTML = printContents;
            $(".remove_when_print").remove();
            window.print();
        
            document.body.innerHTML = originalContents;
        }
    </script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('AdminLTE-2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@endsection