@extends('layouts.adminlte')
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">LISTE DES CHAMBRES</h3>
      <!-- /.card-tools -->
      <div class="card-tools">
          <!-- Boutons, labels, et beaucoup d'autres choses peuvent être placés ici ! -->
          <!-- Voici un label par exemple -->

          <a href="{{ route('room.create') }}" class="badge badge-primary mr-2">ajouter</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="roomlist" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Type de Chambre</th>
                    <th>Numéro</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $data->type_id }}</td>
                        <td>{{ $data->number }}</td>
                        <td>
                            @if ($data->status == 'v')
                                Disponible
                            @elseif ($data->status == 'o')
                                Occupée
                            @elseif ($data->status == 'r')
                                Réservée
                            @elseif ($data->status == 'os')
                                Hors Service
                            @endif
                            {{-- {{ $data->status }} --}}
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('room.edit', $data->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                <a href="{{ route('room.delete', $data->id) }}" onclick="return confirm('Êtes-vous sûr?')" class="btn btn-sm btn-danger">Supprimer</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-footer -->
  </div>

  @section('js')
    <script>
        $(function () {
            $("#roomlist").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#roomlist_wrapper .col-md-6:eq(0)');
        });
    </script>
  @endsection
@endsection
