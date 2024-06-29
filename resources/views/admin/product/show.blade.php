@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <p>{!! $product->desc !!}</p>
    <p>Price: {{ $product->price }}</p>
    <p>Stock: {{ $product->stok }}</p>

    <h3>Images</h3>
    <div class="row">
        @foreach($product->image as $image)
        <div class="col-md-3">
            <img src="{{ Storage::url('tmp/uploads/products/' . $image->file_name) }}" class="img-fluid"
                alt="{{ $product->name }}">
        </div>
        @endforeach
    </div>
</div>
@endsection