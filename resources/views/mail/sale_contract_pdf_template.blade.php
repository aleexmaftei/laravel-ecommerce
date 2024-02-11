<div class="container">
    <div class="title">
        <h3>Model contract de vanzare-cumparare NR. _______/{{ $today_date }}</h3>
    </div>

    <div class="content">
        <div>
            <span>
                Incheiat intre: PF {{ $seller_name }} domiciliat la adresa {{ $seller_address }}, cu codul postal {{ $seller_postal_code }}
                denumita in prezentul contract VANZATOR si PF {{ $buyer_name }} domiciliat la adresa {{ $buyer_address }},
                cu codul postal {{ $buyer_postal_code }}, denumita in prezentul contract CUMPARATOR.
            </span>
        </div>

        <br>
        <br>
        <div>
            <span>..... detalii contract</span>
        </div>

        <br>
        <br>

        <div class="title">
            <h3>Anexa Nr.1 la contractul de vanzare-cumparare nr. ______/{{ $today_date }}</h3>
        </div>
        <div>
            <ol>
                <li>
                    <span>Numele produsului: {{ $product_name }}</span>
                </li>
                <li>
                    <span>Cantitatea: {{ $product_quantity }} buc/kg</span>
                </li>
                <li>
                    <span>Pret unitar: {{ $product_individual_price }} EURO</span>
                </li>
                <li>
                    <span>Valoarea contractului: {{ $product_price }}</span>
                </li>
                <li>
                    <span>Valoarea TVA: {{ $product_tva }}%</span>
                </li>
            </ol>
        </div>
    </div>
</div>
