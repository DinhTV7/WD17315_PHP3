@extends('templates.layout')
@section('content')
    <h1>{{ $title }}</h1>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
    @endif
    <form action="{{ route('edit_customer', ['id' => $detail->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" placeholder="Name" name="name" value="{{ $detail->name }}"><br>
        <input type="text" placeholder="Address" name="address" value="{{ $detail->address }}"><br>
        <input type="text" placeholder="Email" name="email" value="{{ $detail->email }}"><br>
        <input type="text" placeholder="Phone Number" name="phone_number" value="{{ $detail->phone_number }}"><br>
        <input type="date" name="date_of_birth" value="{{ $detail->date_of_birth }}"><br>
        <input type="radio" name="gender" value="0" {{ $detail->gender == 0 ? 'checked' : '' }}>
        <label for="">Nam</label>
        <input type="radio" name="gender" value="1" {{ $detail->gender == 1 ? 'checked' : '' }}>
        <label for="">Nữ</label><br>
        <img id="image_preview" 
        src="{{ $detail->image ? '' . Storage::url($detail->image) : 'https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg'}}" 
        alt="Customer image" style="max-width: 200px; max-height: 100px">
        <input type="file" name="image" accept="image/*" 
        class="@error('image') is-invalid @enderror" id="image">
        <br>
        <button type="submit">Edit</button>
    </form>
@endsection