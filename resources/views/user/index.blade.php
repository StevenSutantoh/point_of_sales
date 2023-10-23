@extends('layouts.app')
@section('title', 'User Info')

@section('content')
    <div class="container">
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
@endsection

{{-- @section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <table border="1">
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
</body>
</html> --}}