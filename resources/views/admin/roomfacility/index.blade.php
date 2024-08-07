@extends('layouts.adminlte')
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">LISTE DES INSTALLATIONS DE CHAMBRE</h3>
      <!-- /.card-tools -->
      <div class="card-tools">
          <!-- Boutons, labels, et beaucoup d'autres choses peuvent être placés ici ! -->
          <!-- Voici un label par exemple -->

          <a href="{{ route('roomfacility.create') }}" class="badge badge-primary mr-2">ajouter</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="facilityRoomlist" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nom de l'installation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $dt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dt->facility_name }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('roomfacility.edit', $dt->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                <a href="{{ route('roomfacility.delete', $dt->id) }}" onclick="return confirm('Êtes-vous sûr ?')" class="btn btn-sm btn-danger">Supprimer</a>
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
            $("#facilityRoomlist").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#facilityRoomlist_wrapper .col-md-6:eq(0)');
        });
    </script>
  @endsection
@endsection
