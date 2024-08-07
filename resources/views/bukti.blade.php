<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reçu de Paiement Hôtel Hebat</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <hr>
                        <h3 class="text text-primary fw-bold">HÔTEL HEBAT</h3>
                        <h6>Reçu de Paiement</h6>
                        <p>Jl. Mana aja No 07 California 177854 (+1) 234-1233</p>
                        <hr>
                        <div class="row">
                            <h6 class="card-subtitle mb-2 col-6">ID de Transaction</h6>
                            <h6 class="card-subtitle mb-2 col-6">: {{ $data->id }}</h6>
                            <h6 class="card-subtitle mb-2 col-6">Nom du Client</h6>
                            <h6 class="card-subtitle mb-2 col-6">: {{ $data->user->name }}</h6>
                            <h6 class="card-subtitle mb-2 col-6">Numéros de Chambre</h6>
                            <h6 class="card-subtitle mb-2 col-6">: {{ $data->nomorKamar }}</h6>
                            <h6 class="card-subtitle mb-2 col-6">Arrivée</h6>
                            <h6 class="card-subtitle mb-2 col-6">: {{ $data->check_in }}</h6>
                            <h6 class="card-subtitle mb-2 col-6">Départ</h6>
                            <h6 class="card-subtitle mb-2 col-6">: {{ $data->check_out }}</h6>
                            <h6 class="card-subtitle mb-2 col-6">Total Chambres</h6>
                            <h6 class="card-subtitle mb-2 col-6">: {{ $data->many_room }}</h6>
                            <h6 class="card-subtitle mb-2 col-6">Prix/Chambre</h6>
                            <h6 class="card-subtitle mb-2 col-6">: @currency($data->room->roomType->price)</h6>
                            <hr>
                            <h6 class="card-subtitle mb-2 col-6">Prix Total</h6>
                            <h6 class="card-subtitle mb-2 col-6">: @currency($data->payment->price)</h6>
                            <center>
                                <h6 class="card-subtitle mt-4 mb-2 col-12">** Merci **</h6>
                            </center>
                        </div>
                    </div>
                    @if(app('router')->getRoutes()->match(app('request')->create(URL::current()))->getName() == 'transaction.proof')
                        <a href="{{ route('transaction.proof.print', $data->id) }}" class="btn btn-primary mt-2 float-right">Télécharger le PDF</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

</body>
</html>
