@extends('templates.layout')
@section('content')
    <h1 class="text-danger">Xin chào các bạn</h1>
    <p>Lập trình php3</p>
    <h2>{{ $title }}</h2>

    {{-- action bắt theo tên của route --}}
    <form action="{{ route('search_customer') }}" method="POST">
        @csrf
        <input type="text" name="search_name">
        <input type="submit" name="btn_search" value="Search">
    </form>

    {{-- Hiển thị thông báo --}}
    @if (Session::has('success'))
        {{Session::get('success')}}
    @endif
    @if (Session::has('error'))
        {{Session::get('error')}}
    @endif

    {{-- {{ $customers }} --}}
    <table border="1">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Address</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Birth day</td>
            <td>Gender</td>
            <td>Action</td>
        </tr>
        @foreach($customers as $customer)
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->address }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone_number }}</td>
            <td>{{ $customer->date_of_birth }}</td>
            <td>{{ $customer->gender == 1 ? "Nam" : "Nữ" }}</td>
            <td>
                <a href="{{ route('edit_customer', [ 'id' => $customer->id ]) }}">Edit</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection