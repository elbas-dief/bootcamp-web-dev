@extends('layouts.main')

@section('title', 'ini adalah show dari product controller')

@section('content')
<h1>Ini file {{$id}}</h1>

@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ini dari Show</title>
</head>
<body>
    <h1>Ini dari Show</h1>
    <p>Nomor {{$id}}</p>
</body>
</html>