@extends("layout.layout")
@vite("resources/sass/product.scss")

@section("body-content")
    <div class="row">
        <div class="col-3"></div>
        <div class="col-9">
            <div class="products-wrapper">
                @foreach($products as $product)
                    <div class="card product-card">
                        <div class="card-body d-inline-flex">
                            <div class="image">
                                <img alt="Product image"
                                     src="https://source.unsplash.com/random"/>
                            </div>

                            <div class="product-content">
                                <div class="product-details">
                                    <h4 class="card-title">{{ $product->name }}</h4>
                                    <p class="card-text">{{ $product->short_description }}</p>
                                </div>

                                <div class="price">
                                    <h4>{{ $product->price }}</h4>
                                </div>
                                @auth("web")
                                    <div class="action-buttons">
                                        @can("can-delete-product")
                                            <form method="POST"
                                                  action="{{ route("products.destroy", ["product_id" => $product->id]) }}">
                                                @csrf
                                                @method("delete")

                                                <button type="submit" class="btn btn-danger">
                                                    <span class="material-symbols-outlined">delete</span>
                                                </button>
                                            </form>
                                        @endcan

                                        @can("can-edit-product", $product)
                                            <a href="{{ route("products.edit", ["category_id" => $category_id, "product_id" => $product->id]) }}"
                                               class="btn btn-primary">Edit</a>
                                        @endcan

                                        @cannot("can-buy-own-products", $product)
                                            <a href="{{ route("order.checkout", ["product_id" => $product->id]) }}"
                                               class="btn btn-primary">Buy</a>
                                        @endcan
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
