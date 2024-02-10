<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>eCommerce</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    @vite(["resources/sass/app.scss", "resources/js/app.js"])
</head>


<body>
@include("layout.navbar")

<div class="eCommerce-page">
    <main role="main" class="grid-container mt-5 mb-3">
        @yield("body-content")
    </main>
</div>

</body>
</html>
