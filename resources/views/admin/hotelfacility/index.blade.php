@extends('layouts.adminlte')
@section('content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">LISTE DES ÉQUIPEMENTS DE L'HÔTEL</h3>
      <div class="card-tools">
          <a href="{{ route('hotelfacility.create') }}" class="badge badge-primary mr-2">ajouter</a>
        </div>
    </div>
    <div class="card-body">
        <table id="facilityList" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nom de l'équipement</th>
                    <th>Description de l'équipement</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $dt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dt->facility_name }}</td>
                        <td>{{ $dt->detail }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('hotelfacility.edit', $dt->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                <a href="{{ route('hotelfacility.delete', $dt->id) }}" onclick="return confirm('Êtes-vous sûr ?')" class="btn btn-sm btn-danger">Supprimer</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

  </div>

  @section('js')
    <script>
        $(function() {
            $("#facilityList").DataTable({
                "responsive": true,
                "paging" : false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#facilityList_wrapper .col-md-6:eq(0)');
        });
    </script>
  @endsection
@endsection
