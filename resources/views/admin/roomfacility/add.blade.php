@extends('layouts.adminlte')
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">AJOUT D'UNE INSTALLATION DE CHAMBRE</h3>
      <!-- /.card-tools -->
      <div class="card-tools">
          <!-- Boutons, labels, et beaucoup d'autres choses peuvent être placés ici ! -->
          <!-- Voici un label par exemple -->

          {{-- <a href="{{ route('admin.facility.room.add') }}" class="badge badge-primary mr-2">ajouter</a> --}}
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <form action="{{ route('roomfacility.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="facility_name">Nom de l'Installation</label>
                <input id="facility_name" name="facility_name" type="text" class="form-control @error('facility_name') is-invalid @enderror" value="{{ old('facility_name') }}" required autocomplete="facility_name" autofocus>

                @error('facility_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group float-right row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Poster') }}
                    </button>
                </div>
            </div>
        </form>

    </div>
    <!-- /.card-footer -->
  </div>
@endsection
