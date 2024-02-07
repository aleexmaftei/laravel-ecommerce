<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>eCommerce</title>
    @vite(["resources/sass/app.scss", "resources/js/app.js"])
</head>


<body>
@include("layout.navbar")

<div class="eCommerce-page">
    <main role="main" class="grid-container">
        @yield("body-content")
    </main>
</div>

</body>
</html>
