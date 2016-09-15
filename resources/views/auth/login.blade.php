@extends('layouts.auth')

@section('content')

    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <h1>Login</h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    {!! csrf_field() !!}
                    <button class="btn btn-primary btn-block">Log in</button>
                </div>
            </form>
        </div>
    </div>

@stop
