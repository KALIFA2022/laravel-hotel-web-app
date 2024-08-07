@extends('layouts.adminlte')
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">AJOUT DE CHAMBRE</h3>
      <!-- /.card-tools -->
      <div class="card-tools">
          <!-- Boutons, labels, et beaucoup d'autres choses peuvent être placés ici ! -->
          <!-- Voici un label par exemple -->

          {{-- <a href="{{ route('admin.room.room.add') }}" class="badge badge-primary mr-2">ajouter</a> --}}
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <form action="{{ route('room.store') }}" method="post">
            @csrf
            <div class="row">

                <div class="form-group col-md-6">
                    <label for="type_id">Type</label>
                    <select name="type_id" id="type_id" class="form-control @error('type_id') is-invalid @enderror" value="{{ old('type_id') }}" required autocomplete="type_id" autofocus>
                        <option disabled selected>Sélectionnez le type de chambre...</option>
                        @foreach ($typeRooms as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>

                    @error('type_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="number">Numéro</label>
                    <input id="number" name="number" type="text" class="form-control @error('number') is-invalid @enderror" value="{{ old('number') }}" required autocomplete="number" autofocus>

                    @error('number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
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
