@extends('layouts.template')

@section('content')
<section class="accomodation_area section_gap">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="section-heading">
                <h2>
                    <center>
                        Liste des Transactions
                    </center>
                </h2>
            </div>
        </div>
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>Type de Chambre</th>
                            <th>Numéro de Chambre</th>
                            <th>Quantité Commandée</th>
                            <th>Prix par Nuit</th>
                            <th>Prix Total</th>
                            <th>État de la Transaction</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($datas == '[]')
                            <tr class="text-center table-primary">
                                <td colspan="7">Aucune transaction</td>
                            </tr>
                        @else
                            @foreach ($datas as $item)
                                <tr class="text-center table-primary">
                                    <td>{{ $item->room->roomType->name }}</td>
                                    <td>{{ $item->roomNumber->number }}</td>
                                    <td>{{ $item->many_room }}</td>
                                    <td>@currency($item->room->roomType->price)</td>
                                    <td>@currency($item->payment->price)</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        @if ($item->status == 'canceled')
                                            Transaction Annulée
                                        @elseif ($item->status == 'process')
                                            Transaction en Cours
                                        @elseif ($item->status == 'verified')
                                            <a href="{{ route('transaction.proof', $item->id) }}" class="btn btn-sm btn-success">Imprimer la Preuve</a>
                                        @elseif ($item->status == 'failed')
                                            Échec de la Transaction
                                        @elseif ($item->status == 'rejected')
                                            Votre preuve a été rejetée par le Réceptionniste, <br>veuillez télécharger votre preuve à nouveau !
                                            <a data-toggle="modal" data-target="#{{ 'uploadProof'.$item->id }}" class="btn btn-sm btn-primary text-white">Télécharger la Preuve</a>
                                            <div class="modal fade" id="{{ 'uploadProof'.$item->id }}" tabindex="-1" role="dialog" aria-labelledby="uploadProofLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="uploadProofLabel">Téléchargez votre preuve de paiement</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                    <form action="{{ route('upload.proof') }}" method="post" enctype="multipart/form-data">
                                                        @csrf

                                                        <input type="hidden" name="payment_id" value="{{ $item->id }}">
                                                        <div class="modal-body">
                                                            <div class="form-row">

                                                                <div class="form-group col-md-12">
                                                                    <label for="foto">Image de Preuve</label>
                                                                    <input id="foto" name="foto" type="file" class="form-control @error('foto') is-invalid @enderror" value="{{ old('foto') }}" required autocomplete="foto" autofocus>

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

                                                            <button type="submit" class="btn btn-sm btn-primary">Payer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @elseif($item->status == 'checked in')
                                            Enregistré le {{ $item->updated_at }}
                                        @elseif($item->status == 'checked out')
                                            Départ le {{ $item->updated_at }}
                                        @else
                                            <div class="btn-group">
                                                <a href="{{ route('customer.cancel.transaction', $item->id) }}" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette transaction ?')" class="btn btn-sm btn-danger">Annuler</a>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#payType">
                                                    Payer
                                                </button>
                                            </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="payType" tabindex="-1" role="dialog" aria-labelledby="payTypeLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="payTypeLabel">Sélectionnez le Type de Paiement</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        <form action="{{ route('customer.pay.transaction', $item->id) }}" method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-row">

                                                                    <select name="pay_type" id="pay_type" class="form-control col-md-12 @error('pay_type') is-invalid @enderror" value="{{ old('pay_type') }}" required autocomplete="pay_type" autofocus>
                                                                        <option value="dana">DANA</option>
                                                                        <option value="ovo">OVO</option>
                                                                        <option value="gopay">GOPAY</option>
                                                                        <option value="mandiriva">Mandiri VA</option>
                                                                        <option value="briva">BRI VA</option>
                                                                        <option value="bcava">BCA VA</option>
                                                                    </select>
                                                                    @error('pay_type')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                    @enderror
                                                                </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>

                                                                <button type="submit" class="btn btn-sm btn-primary">Payer</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div>
                <a href="{{ route('landing') }}" class="btn btn-md btn-warning float-right mx-2">Retour à l'Accueil</a>
                @if ($pay != '0')

                <button type="button" class="btn btn-md btn-success float-right" data-toggle="modal" data-target="#payAllType">
                    Payer Tout
                </button>
                @endif

                <div class="modal fade" id="payAllType" tabindex="-1" role="dialog" aria-labelledby="payAllTypeLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="payAllTypeLabel">Sélectionnez le Type de Paiement</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <form action="{{ route('customer.invoice') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-row">

                                            <select name="pay_type" id="pay_type" class="form-control col-md-12 @error('pay_type') is-invalid @enderror" value="{{ old('pay_type') }}" required autocomplete="pay_type" autofocus>
                                                <option value="dana">DANA</option>
                                                <option value="ovo">OVO</option>
                                                <option value="gopay">GOPAY</option>
                                                <option value="mandiriva">Mandiri VA</option>
                                                <option value="briva">BRI VA</option>
                                                <option value="bcava">BCA VA</option>
                                            </select>
                                            @error('pay_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
                                        <button type="submit" class="btn btn-sm btn-primary">Payer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
