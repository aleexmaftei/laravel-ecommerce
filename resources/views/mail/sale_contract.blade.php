<div class="container">
    <div class="title">
        <h1>New sale</h1>
    </div>

    <div class="content">
        <span> A new transaction has been made. Here are a few details about the order:</span>
        <ul>
            <li>
                <span>Client name: {{ $buyer->first_name }} {{ $buyer->last_name }}</span>
            </li>

            <li>
                <span>Product bought: {{ $product->name }}</span>
            </li>

            <li>
                <span>Quantity: {{ $quantity }}</span>
            </li>

            <li>
                <span>Total price: {{ $quantity * $product->price }}</span>
            </li>
        </ul>
    </div>
</div>
