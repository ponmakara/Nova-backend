@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus"></i> Add Product
    </a>
</div>

<div class="row g-4">
    @foreach($products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card product-card h-100">
                <div class="position-relative">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <span class="text-muted">No image</span>
                        </div>
                    @endif
                    <span class="badge bg-danger position-absolute top-0 start-0 m-3">-25%</span>
                    <button class="btn btn-light btn-sm position-absolute top-0 end-0 m-3 rounded-circle" style="width: 35px; height: 35px;">
                        <i class="bi bi-heart"></i>
                    </button>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-muted small">{{ Str::limit($product->description ?? 'No description', 80) }}</p>
                    <div class="d-flex align-items-center mb-2">
                        <span class="fw-bold fs-5 text-danger">${{ number_format($product->price, 2) }}</span>
                        <span class="text-muted text-decoration-line-through ms-2">${{ number_format($product->price * 1.25, 2) }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <span class="text-muted small ms-2">(120)</span>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0">
                    <div class="d-flex flex-column gap-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary w-100">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure?')">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<style>
.product-card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}
</style>
@endsection
