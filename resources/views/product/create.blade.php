@extends("layout.layout")
@vite("resources/sass/product.scss")

@section("body-content")
    <div class="create-product">
        <div class="title">
            <h1>Create a new product</h1>
        </div>
        <br>
        <form method="POST" action="{{ route("products.store", ["category_id" => $category_id]) }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">
                    <span>Product name</span>
                    <input class="form-control" type="text" name="name" value="{{ old("name") }}"/>
                </label>

                @error("name")
                <div class="alert alert-danger">
                    {{ $errors->first("name") }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">
                    <span>Price</span>
                    <input class="form-control" type="number" name="price" value="{{ old("price") }}"/>
                </label>

                @error("price")
                <div class="alert alert-danger">
                    {{ $errors->first("price") }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tva_percentage">
                    <span>TVA percentage</span>
                    <input class="form-control" type="number" name="tva_percentage" min="0" max="100"
                           value="{{ old("tva_percentage") }}"/>
                </label>

                @error("tva_percentage")
                <div class="alert alert-danger">
                    {{ $errors->first("tva_percentage") }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="quantity">
                    <span>Quantity</span>
                    <input class="form-control" type="number" name="quantity" min="1"
                           value="{{ old("quantity") }}"/>
                </label>

                @error("quantity")
                <div class="alert alert-danger">
                    {{ $errors->first("quantity") }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="short_description">
                    <span>Short description</span>
                    <textarea class="form-control" name="short_description">{{ old("short_description") }}</textarea>
                </label>

                @error("short_description")
                <div class="alert alert-danger">
                    {{ $errors->first('short_description') }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">
                    <span>Description</span>
                    <textarea class="form-control" name="description"> {{ old("description") }}</textarea>
                </label>


                @error("description")
                <div class="alert alert-danger">
                    {{ $errors->first('description') }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
