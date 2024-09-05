@extends('layouts.app')

@section('content')
    <div class="menu-content bg-white">
        <h1 class="h1-custom">Welcome PIAZZA ORSILLO’s Menu</h1>

        <div class="container">
            <div class="row">
                <!-- Filter Section (Left) -->
                <div class="col-md-3 border-end">
                    <h5>Filter Products</h5>
                    <hr>
                    <!-- Filter Form -->
                    <form action="{{ route('menu') }}" method="GET">
                        <!-- Category Filter -->
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Name Search Filter -->
                        <div class="form-group mb-2">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="Search by name">
                        </div>
                        <div class="form-group mb-2">
                            <label for="sort">Sort By</label>
                            <select name="sort" id="sort" class="form-select">
                                <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Default</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                            </select>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-warning">Apply</button>
                    </form>
                </div>

                <!-- Products Section (Right) -->
                <div class="col-md-9 mt-3 mt-lg-0">
                    <h5>Products</h5>
                    <hr>
                    <!-- Display Products -->
                    <div class="row">
                        @forelse($products as $product)
                            <div class="col-lg-4 col-6 mb-4">
                                <div class="card" style="height: 230px; display: flex; flex-direction: column; position: relative;">
                                    <!-- Product Image -->
                                    <div class="text-center" style="flex: 1; display: flex; align-items: center; justify-content: center; height: 50%; position: relative;">
                                        <img style="max-height: 100%; max-width: 100%; object-fit: contain;" src="{{ $product->image_url }}" class="card-img-top" alt="No Image">
                                        <!-- Category Overlay -->
                                        <div class="category-overlay" style="position: absolute; top: 0; left: 0; background: rgba(0, 0, 0, 0.7); color: white; padding: 5px 10px; border-radius: 3px;">
                                            {{ $product->category->name }}
                                        </div>
                                    </div>

                                    <!-- Product Details -->
                                    <div class="card-body d-flex flex-column" style="flex: 1; overflow: hidden;">
                                        <!-- Short Description -->
                                        <p class="card-text">{{ $product->short_description }}</p>

                                        <!-- Push the Name and Price to the Bottom -->
                                        <div class="mt-3  justify-content-between align-items-center">
                                            <!-- Product Name (Prevent Overflow) -->
                                            <h5 class="card-title mb-3 text-truncate" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin: 0;">
                                                {{ $product->name }}
                                            </h5>
                                            <!-- Product Price and View More Button -->
                                            <div style="display: flex; justify-content: space-between;">
                                                <!-- Product Price -->
                                                <p class="card-text mb-0" style="margin-right: 10px;">
                                                    <strong>${{ number_format($product->price, 2) }}</strong>
                                                </p>

                                                <!-- View More Button -->
                                                <a href="https://piazzaorsillo.pdqonlineordering.com/Titlepage.aspx"
                                                   target="_blank"
                                                   class="btn btn-warning btn-sm">Order Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @empty
                            <p>No products found</p>
                        @endforelse
                    </div>

                    <!-- Pagination (Optional) -->
                    <div class="d-flex justify-content-center mb-2">
                        {{ $products->appends(request()->input())->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
