@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="card-header">
            <h3 class="card-title">Enregistrement Client</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('receptionis.checkin.pdata.post') }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="transaction_id">ID de la Transaction</label>
                        <input list="transactions" id="transaction_id" name="transaction_id" type="text" class="form-control @error('transaction_id') is-invalid @enderror" value="{{ old('transaction_id') }}" required autocomplete="off" autofocus />
                        <datalist id="transactions">
                            @foreach ($transactions as $item)
                                <option value="{{ $item->id }}">{{ $item->user->name }}</option>
                            @endforeach
                        </datalist>
                        @error('transaction_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Nom</label>
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Adresse</label>
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" rows="3" required autocomplete="address" autofocus>{{ old('address') }}</textarea>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="gender">Genre</label>
                        <div class="form-radio ml-2">
                            <input class="form-radio-input" type="radio" name="gender" value="male" id="male">
                            <label class="form-radio-label" for="male">Homme</label>
                        </div>
                        <div class="form-radio ml-2">
                            <input class="form-radio-input" type="radio" name="gender" value="female" id="female">
                            <label class="form-radio-label" for="female">Femme</label>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="job">Métier</label>
                        <input id="job" name="job" type="text" class="form-control @error('job') is-invalid @enderror" value="{{ old('job') }}" required autocomplete="job" autofocus>
                        @error('job')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="birthdate">Date de Naissance</label>
                        <input id="birthdate" name="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" value="{{ old('birthdate') }}" required autocomplete="birthdate" autofocus>
                        @error('birthdate')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right mt-2">
                        {{ __('Soumettre') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3 class="card-title">Clients Enregistrés</h3>
        </div>
        <div class="card-body">
            <table id="transaction" class="display" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nom du Client</th>
                        <th>Type de Chambre</th>
                        <th>Numéro de Chambre</th>
                        <th>Nombre de Réservations</th>
                        <th>Check In - Check Out</th>
                        <th>Date de Réservation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $item)
                        <tr class="text-center table-primary">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->customer->name }}</td>
                            <td>{{ $item->room->roomType->name }}</td>
                            <td>{{ $item->roomNumber->number }}</td>
                            <td>{{ $item->many_room }}</td>
                            <td>{{ $item->check_in . ' - ' . $item->check_out }}</td>
                            <td>{{ $item->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('receptionis.pdata.checkout', $item->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer le Check-Out pour la transaction {{ $item->user->name }} ?')">Check-Out</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function() {
        $("#transaction").DataTable({
            "responsive": true,
            "paging": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#facilityList_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
