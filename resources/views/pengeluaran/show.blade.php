@extends('layouts.app')
@section('title', 'Daftar Pengeluaran')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Pengeluaran #{{ $pengeluaran->id_pengeluaran }}</div>
                    <div class="card-body">

                        <a href="{{ url('/pengeluaran') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/pengeluaran/' . $pengeluaran->id_pengeluaran . '/edit') }}" title="Edit Pengeluaran"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('/pengeluaran' . '/' . $pengeluaran->id_pengeluaran) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Pengeluaran" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $pengeluaran->id_pengeluaran }}</td>
                                    </tr>
                                    <tr><th> Nama Pengeluaran </th><td> {{ $pengeluaran->nama_pengeluaran }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
