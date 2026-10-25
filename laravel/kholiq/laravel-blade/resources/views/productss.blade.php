<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk with var custom</title>
</head>

<body>
    <div class="d-flex justify-content-center">
        <h1>Produk saya namanya adalah {{$nama}} dan {{$nama2}}</h 1>
    </div>
    @if($nama == null && $nama2 == null)
        <h1>404 not found</h1>
    @elseif($nama == null && $nama2 != null)
        <h1>Ada isinya {{$nama2}}</h1>
    @elseif($nama != null && $nama2 == null)
        <h1>Ada isinya {{$nama}}</h1>
    @else
        <h1>Ada semuanya</h1>
    @endif
</body>

</html>