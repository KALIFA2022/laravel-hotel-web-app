<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->
    <!-- Vous pouvez ajouter le logo de l'entreprise ici -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('images/logo.png')}}" class="img-circle elevation-2" alt="Image de l'utilisateur">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Str::ucfirst(Auth::user()->role) }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Recherche" aria-label="Recherche">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Ajoutez des icônes aux liens en utilisant la classe .nav-icon
                     avec font-awesome ou toute autre bibliothèque d'icônes -->
                <li class="nav-item">
                    <a href="{{route('room.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Chambres</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('roomtype.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Types de Chambres</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('roomfacility.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Équipements de Chambre</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('hotelfacility.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Équipements de l'Hôtel</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.logs') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Logs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <p>
                           {{ __('Déconnexion') }}
                        </p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
