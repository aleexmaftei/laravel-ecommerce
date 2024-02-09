@vite("resources/sass/category.scss")
@extends("layout.layout")

@section("body-content")
<div class="container">
    @if(!is_null($categories))
        @include("home")

        <h2 class="d-flex justify-content-center">Categories</h2>
    @elseif(!is_null($subcategories))
        <h2 class="d-flex justify-content-center">Subcategories</h2>
    @endif


    <div class="container d-flex justify-content-center">
        <div class="row">

            @if(!is_null($categories))
                @foreach($categories as $category)
                    <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-4 mt-2">
                        <div class="card-wrapper">
                            <a href="{{ route("category.show_subcategories", ["category_id" => $category->id]) }}">
                                <div class="d-inline-flex align-items-center">
                                    <img class="image" alt="Product category image"
                                         src="https://www.imgonline.com.ua/examples/enlarged-photo.jpg"/>
                                    <div>
                                        <span>{{ $category->name }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @elseif(!is_null($subcategories))
                @foreach($subcategories as $subcategory)
                    <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4 mb-4 mt-2">
                        <div class="card-wrapper">
                            <a href="{{ route("products.index", ["category_id" => $subcategory->id]) }}">
                                <div class="d-inline-flex align-items-center">
                                    <img class="image" alt="Product category image"
                                         src="https://www.imgonline.com.ua/examples/enlarged-photo.jpg"/>
                                    <div>
                                        <span>{{ $subcategory->name }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</div>
@endsection
