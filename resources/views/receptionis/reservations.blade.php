@extends('layouts.app')

@section('content')
<div class="container-fluid px-3">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>
                    <center>
                        Liste des Transactions
                    </center>
                </h2>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                            <table id="transaction" class="display" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nom du Client</th>
                                        <th>Numéro de Téléphone</th>
                                        <th>Type de Chambre</th>
                                        <th>Quantité Commandée</th>
                                        <th>Check-in - Check-out</th>
                                        <th>Date de Réservation</th>
                                        <th>Prix par Nuit</th>
                                        <th>Prix Total</th>
                                        <th>État de la Transaction</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $item)

                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->phone }}</td>
                                        <td>{{ $item->room->roomType->name }}</td>
                                        <td>{{ $item->many_room }}</td>
                                        <td>{{ $item->check_in . ' - ' . $item->check_out}}</td>
                                        <td>{{ $item->created_at->diffForHumans() }}</td>
                                        <td>@currency($item->room->roomType->price)</td>
                                        <td>@currency($item->payment->price)</td>
                                        <td>{{ Str::ucfirst($item->status) }}</td>
                                        <td>
                                            @if ($item->status == 'canceled')
                                                Transaction Annulée
                                            @elseif ($item->status == 'failed')
                                                Échec de la Transaction
                                            @elseif ($item->status == 'process')

                                                <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#{{ 'haha'.$item->id }}">Preuve</a>

                                                <div class="modal fade" id="{{ 'haha'.$item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">

                                                        <h4 class="modal-title" id="myModalLabel">Image de Preuve</h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        <center>

                                                            <img width="400px" src="{{ asset('images/bukti/'.$item->payment->bukti) }}" alt="">
                                                        </center>
                                                    <div class="modal-footer">
                                                        <a onclick="return confirm('Changer le statut en Vérifié ?')" class="btn btn-sm btn-success" href="{{ route('receptionis.toverified', $item->id) }}">Vérifier</a>
                                                        <a onclick="return confirm('Changer le statut en Rejeté ?')" class="btn btn-sm btn-danger" href="{{ route('receptionis.torejected', $item->id) }}">Rejeter</a>
                                                        <button type="button" class="btn btn-sm btn-secondary float-right" data-dismiss="modal">Fermer</button>
                                                    </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>

                                            @elseif ($item->status == 'verified')
                                                Transaction Réussie
                                            @elseif ($item->status == 'rejected')
                                                Rejetée
                                            @elseif($item->status == 'waiting for payment')
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="{{ '#uploadProof'.$item->id }}">
                                                    Télécharger la Preuve
                                                </button>

                                            @elseif($item->status == 'checked in')
                                                Enregistré le {{ $item->updated_at }}
                                            @elseif($item->status == 'checked out')
                                                Départ le {{ $item->updated_at }}
                                            @endif

                                         {{-- MODAL UPLOAD BUKTI --}}
                                         <div class="modal fade" id="{{ 'uploadProof'.$item->id }}" tabindex="-1" role="dialog" aria-labelledby="uploadProofLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="uploadProofLabel">Téléchargez votre preuve de paiement</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                <form action="{{ route('receptionis.upload.proof') }}" method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <input type="hidden" name="payment_id" value="{{ $item->id }}">
                                                    <div class="modal-body">
                                                        <div class="form-row">

                                                            <div class="form-group col-md-12">
                                                                <label for="foto">Image de Preuve</label>
                                                                <input id="foto" name="foto" type="file" class="form-control @error('foto') is-invalid @enderror"  value="{{ old('foto') }}" required autocomplete="foto" autofocus>

                                                                @error('foto')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>

                                                            <button type="submit" class="btn btn-sm btn-primary">Envoyer</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/buttons.print.min.js') }}"></script>
<script>
    $(function() {
        $("#transaction").DataTable({
            "responsive": true,
            "paging" : false,
            "dom": 'Bfrtip',
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        });
    });
</script>
@endsection
