@extends('layouts.app')
@section('title', 'Daftar Supplier Barang')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Supplier Barang #{{ $supplier->id_supplier }}</div>
                    <div class="card-body">

                        <a href="{{ url('/supplier') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/supplier/' . $supplier->id_supplier . '/edit') }}" title="Edit Supplier"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('/supplier' . '/' . $supplier->id_supplier) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Supplier" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $supplier->id_supplier }}</td>
                                    </tr>
                                    <tr>
                                        <th> Nama Supplier </th><td> {{ $supplier->nama_supplier }} </td>
                                    </tr>
                                    <tr>
                                        <th> Alamat </th><td> {{ $supplier->alamat }} </td>
                                    </tr>
                                    <tr>
                                        <th> Telepon </th><td> {{ $supplier->telepon }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
