@extends('layouts.app')
@section('title', 'User Info')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">User Info</div>
                    <div class="card-body">
                        <div class="container">
                            <table height="150px" width="600px" border="1">
                                <tr>
                                    <td>Nama</td>
                                    <td>Email</td>
                                </tr>
                    
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $d->name }}</td>
                                        <td>{{ $d->email }}</td>
                                    </tr>
                                    @endforeach
                            </table>
                        </div>    

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection