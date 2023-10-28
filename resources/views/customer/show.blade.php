@extends('layouts.app')
@section('title', 'Daftar Customer')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Customer #{{ $customer->id_customer }}</div>
                    <div class="card-body">

                        <a href="{{ url('/customer') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/customer/' . $customer->id_customer . '/edit') }}" title="Edit Customer"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('/customer' . '/' . $customer->id_customer) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Customer" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $customer->id_customer }}</td>
                                    </tr>
                                    <tr>
                                        <th> Nama Customer </th><td> {{ $customer->nama_customer }} </td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th><td>{{ $customer->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th> Telepon </th><td> {{ $customer->telepon }} </td>
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
