@extends('layouts.app')
@section('title', 'Data Barang')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">barang {{ $barang->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/barang') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/barang/' . $barang->id . '/edit') }}" title="Edit barang"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('admin/barang' . '/' . $barang->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete barang" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $barang->id }}</td>
                                    </tr>
                                    <tr><th> Kode Barang </th><td> {{ $barang->kode_barang }} </td></tr><tr><th> Kode Kategori </th><td> {{ $barang->kode_kategori }} </td></tr><tr><th> Nama Barang </th><td> {{ $barang->nama_barang }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
