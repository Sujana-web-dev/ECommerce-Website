@extends('frontend.layouts.master')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Product Listing</h2>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('images/' . $product['image']) }}" class="card-img-top" alt="{{ $product['name'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product['name'] }}</h5>
                    <p class="card-text">Price: {{ $product['price'] }} ৳</p>
                    <form action="{{ route('cart.add', $product['id']) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
