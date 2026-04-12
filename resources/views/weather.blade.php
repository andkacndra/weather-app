<!DOCTYPE html>
<html>
<head>
    <title>Weather App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            color: rgb(0, 0, 0);
            min-height: 100vh;
        }

        .card {
            border-radius: 20px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border: none;
            text-align: center;
        }

        .search-box {
            max-width: 400px;
            margin: auto;
        }

        .form-control {
            border-radius: 30px;
            padding: 12px;
        }

        .btn {
            border-radius: 30px;
        }
    </style>
</head>

<body>

<div class="container text-center mt-5">

    <h1 class="mb-4">Weather App</h1>

    <!-- FORM -->
    <div class="search-box">
        <form method="POST" action="/weather">
            @csrf
            <input type="text" name="kota" class="form-control mb-3" placeholder="Masukkan kota..." required>
            <button class="btn btn-light w-100">Cek Cuaca</button>
        </form>
    </div>

    <!-- ERROR -->
    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

    <!-- HASIL -->
    @if(isset($cuaca))
        <div class="card mt-5 p-4">
            <h2>{{ $kota }}</h2>
            <h1>{{ $cuaca['temperature'] }}°C</h1>
            <p>Kecepatan Angin: {{ $cuaca['windspeed'] }} km/h</p>
            <p>Arah Angin: {{ $cuaca['winddirection'] }}°</p>
        </div>
    @endif

</div>

</body>
</html>
