@extends('frontend.layouts.master')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Product Listing</h2>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                @if($product['image'])
                    <img src="{{ asset('storage/' . $product['image']) }}" class="card-img-top" alt="{{ $product['name'] }}"
                         onerror="this.onerror=null;this.style.display='none';this.nextElementSibling.style.display='block';">
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="display:none;height:200px;">
                        <i class="fas fa-image text-muted" style="font-size:3rem;"></i>
                    </div>
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                        <i class="fas fa-image text-muted" style="font-size:3rem;"></i>
                    </div>
                @endif
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
