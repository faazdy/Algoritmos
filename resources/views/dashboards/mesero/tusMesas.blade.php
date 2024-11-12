<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../../../public/css/cards.css">
    <link rel="stylesheet" href="../../../../public/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tus Mesas</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Portal Mesero | Chapinero</a>
            <!-- Resto de tu navbar aquí -->
        </div>
    </nav>
    <main style="background-color: rgb(250, 250, 250);">
        <section>
            <h2>Tus Mesas</h2>
            <article class="cards-container-mesero">
                @foreach($mesasAtendiendo as $mesa)
                    <div class="card text-center">
                        <span>
                            <img src="{{ asset('imgs/mesa.webp') }}" alt="">
                        </span>
                        <h5>Mesa #{{ $mesa->id }}</h5>
                        <a href="{{ route('tomar.pedido', $mesa->id) }}" class="btn btn-warning">Tomar pedido</a>
                    </div>
                @endforeach
            </article>
        </section>
    </main>
</body>
</html>