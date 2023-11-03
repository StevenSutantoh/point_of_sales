<?php 
    $current_type = request()->segment(count(request()->segments()));
    if(Str::contains($current_type, 'type')){
        $type = explode('=',$current_type)[1];
    }
    else {
        $type = '';
    }
?>
@if($type == '')
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-12">
            <h3>Harap pilih laporan yang ingin ditampilkan</h3>
        </div>
    </div>
@endif
@if ($type == 'sales')
    <div class="row">
        <div class="col-xm-6 col-sm-6 col-md-6 col-lg-6">
            <h4>
                <strong>Total Penjualan : Rp. {{number_format($total->sum('total_penjualan'))}}</strong>
            </h4>
        </div>
    </div>
@elseif ($type == 'purchase')
    <div class="row">
        <div class="col-xm-6 col-sm-6 col-md-6 col-lg-6">
            <h4>
                <strong>Total Pembelian : Rp. {{number_format($total->sum('total_pembelian'))}}</strong>
            </h4>
        </div>
    </div>
@elseif ($type == 'expense')
    <div class="row">
        <div class="col-xm-6 col-sm-6 col-md-6 col-lg-6">
            <h4>
                <strong>Total Pengeluaran : Rp. {{number_format($total->sum('nominal'))}}</strong>
            </h4>
        </div>
    </div>
@endif
@if ($type == 'sales' || $type =='purchase')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Metode Pembayaran</th>
                @if ($type == 'sales')
                    <th>Status Pembayaran</th>
                @endif
                <th>Total Pembelian</th>
                <th width="40%">Detail</th>
                <th>Invoice dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $item)
                @if ($type == 'sales')
                    <tr>
                        <td>{{$item->id_penjualan}}</td>
                        <td>{{$item->nama_customer}}</td>
                        <td>{{$item->tanggal}}</td>
                        <td><strong>{{strtoupper($item->metode_pembayaran)}}</strong></td>
                        <td><strong>{{strtoupper($item->status_pembayaran)}}</strong></td>
                        <td>Rp. {{number_format($item->total_penjualan)}}</td>
                        <td>
                            <ul>
                                @foreach ($item->details as $datum)
                                    <li>{{$datum->nama_barang}} - {{$datum->kuantitas}}pcs @ Rp. {{number_format($datum->harga_jual)}}</li>
                                @endforeach
                                {{-- ➔ --}}
                            </ul>
                        </td>
                        <td>{{$item->created_at}}</td>
                    </tr>
                @else 
                <tr>
                    <td>{{$item->id_pembelian}}</td>
                    <td>{{$item->nama_supplier}}</td>
                    <td>{{$item->tanggal}}</td>
                    <td><strong>{{strtoupper($item->metode_pembayaran)}}</strong></td>
                    <td>Rp. {{number_format($item->total_pembelian)}}</td>
                    <td>
                        <ul>
                            @foreach ($item->details as $datum)
                                <li>{{$datum->nama_barang}} - {{$datum->kuantitas}}pcs @ Rp. {{number_format($datum->harga_beli)}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{$item->created_at}}</td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@elseif($type == 'expense')
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Deskripsi</th>
            <th>Nominal</th>
            <th>Dibuat pada</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $item)
            <tr>
                <td>{{$item->id_pengeluaran}}</td>
                <td>{{$item->deskripsi}}</td>
                <td>Rp. {{number_format($item->nominal)}}</td>
                <td>{{$item->created_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif