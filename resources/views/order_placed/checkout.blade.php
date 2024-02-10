@extends("layout.layout")
@vite("resources/sass/order_placed.scss")

@section("body-content")
    <div class="checkout">
        <form method="POST" action="{{ route("place.order", ["product_id" => $product->id]) }}">
            @csrf

            <div class="form-group">
                <label for="quantity">
                    <span>Quantity to buy</span>
                    <input class="form-control" type="number" name="quantity" min="1" max="{{ $product->quantity }}"
                           value="{{ old("quantity") }}"/>
                    <small>Maximum quantity: {{ $product->quantity }}</small>
                </label>
            </div>

            @error("quantity")
            <div class="alert alert-danger">
                {{ $errors->first('quantity') }}
            </div>
            @enderror

            <hr/>
            <div class="delivery-locations">
                <div class="order-addresses-wrapper">
                    <p>Choose a billing address</p>
                    <div class="form-group">
                        @foreach($delivery_locations as $delivery_location)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="delivery_location_id"
                                           id="delivery-location-{{ $delivery_location->id }}"
                                           value="{{ $delivery_location->id }}">

                                    <span>Address: {{ $delivery_location->address_detail}}</span>
                                    <br>
                                    <span>Postal code: {{ $delivery_location->postal_code }}</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @error("delivery_location_id")
            <div class="alert alert-danger">
                {{ $errors->first('delivery_location_id') }}
            </div>
            @enderror

            <button type="submit" class="btn btn-primary">Place order</button>
        </form>
    </div>
@endsection
