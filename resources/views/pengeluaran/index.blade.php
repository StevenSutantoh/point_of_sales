@extends('layouts.app')
@section('title', 'Daftar Pengeluaran')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Pengeluaran</div>
                    <div class="card-body">
                        <a href="{{ url('/pengeluaran/create') }}" class="btn btn-success btn-sm" title="Add New Pengeluaran">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/pengeluaran') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th><th>Nama Pengeluaran</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($pengeluaran as $item)
                                    <tr>
                                        <td>{{ $item->id_pengeluaran }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>{{ $item->nominal }}</td>
                                        <td>
                                            <a href="{{ url('/pengeluaran/' . $item->id_pengeluaran) }}" title="View Pengeluaran"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/pengeluaran/' . $item->id_pengeluaran . '/edit') }}" title="Edit Pengeluaran"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/pengeluaran' . '/' . $item->id_pengeluaran) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Pengeluaran" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $pengeluaran->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
