@extends('templates.layout')
@section('content')
    <h1>{{ $title }}</h1>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
    @endif
    <form action="{{ route('add_customer') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" placeholder="Name" name="name" ><br>
        <input type="text" placeholder="Address" name="address" ><br>
        <input type="text" placeholder="Email" name="email" ><br>
        <input type="text" placeholder="Phone Number" name="phone_number" ><br>
        <input type="date" name="date_of_birth" ><br>
        <input type="radio" name="gender" value="0" checked>
        <label for="">Nam</label>
        <input type="radio" name="gender" value="1">
        <label for="">Nữ</label><br>

        <img id="image_preview" src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg" 
        alt="Customer image" style="max-width: 200px; max-height: 100px">
        <input type="file" name="image" accept="image/*" 
        class="@error('image') is-invalid @enderror" id="image">
        <br>
        <button type="submit">Add new</button>
    </form>
@endsection