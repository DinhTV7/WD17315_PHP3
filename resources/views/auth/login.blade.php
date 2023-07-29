@extends('templates.layout')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif
    @if (Session::has('success'))
        {{ Session::get('success') }}
    @endif
    @if (Session::has('error'))
        {{ Session::get('error') }}
    @endif
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-4" style="width: 400px;">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-4" style="width: 400px;">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <p>Đăng ký tài khoản mới?<a href="{{ route('register') }}">Đăng ký</a></p>
@endsection
