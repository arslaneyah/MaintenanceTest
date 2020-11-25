<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MAINTENANCE TVE</title>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script
        src="{{ url('//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js') }}"></script>
    <script src="/plugins/datatables/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/datatables/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/plugins/datatables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/js/deleteconfirm.js"></script>
    <script>
        $(function () {
            $("#dTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": []

            })});
    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@include('sweetalert::alert')
@guest
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-light shadow-sm  ">
            <div class="container">

                <a class="navbar-brand"><img src="{{asset('img/logoicon.png')}}" style="height: 30px"></a>

                <a class="navbar-brand" href="{{ url('/home') }}">
                    MAINTENANCE TVE
                </a>
                <a class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent"
                   aria-controls="navbarSupportedContent" aria-expanded="false"
                   aria-label="{{ __('Toggle navigation') }}">
                    <span class="fas fa-bars"></span>
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="navbar-brand"
                                aria-expanded="false" v-pre>
                                Bienvenue !
                            </a>

                        </li>


                    </ul>
                </div>
            </div>

        </nav>
        <!-- Main Sidebar Container -->


    </div>

    <main>
        @yield('content')
    </main>
@else
    @if(!(Auth::user()->role=='admin'))
        <div id="app">

            <nav class="navbar navbar-expand-md navbar-light shadow-sm  ">
                <div class="container">

                        <a class="navbar-brand"><img src="{{asset('img/logoicon.png')}}" style="height: 30px"></a>

                    <a class="navbar-brand" href="{{ url('/home') }}">
                        MAINTENANCE TVE
                    </a>
                    <a class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent"
                       aria-controls="navbarSupportedContent" aria-expanded="false"
                       aria-label="{{ __('Toggle navigation') }}">
                        <span class="fas fa-bars"></span>
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> Véhicules
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->role=='agent')
                                        <a class="dropdown-item" href="/Kilometrage/create">
                                            Kilometrage
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="/createstatsvehicule">
                                        Statistiques Véhicule
                                    </a>

                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> Gasoil
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/Gasoil/">
                                        Suivie
                                    </a>
                                    @if(Auth::user()->role=='agent')
                                        <a class="dropdown-item" href="/Gasoil/create">
                                            Ajouter
                                        </a>
                                    @endif
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Alimentation Cuve
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/Alimentation_Cuve">
                                        Suivie
                                    </a>
                                    @if(Auth::user()->role=='admin' || Auth::user()->role=='agent')
                                        <a class="dropdown-item" href="/Alimentation_Cuve/create">
                                            Alimenter
                                        </a>
                                    @endif

                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>


                        </ul>
                    </div>
                </div>

            </nav>
            <!-- Main Sidebar Container -->


        </div>
        <main class="mt-6 pt-2">
            @yield('content')
        </main>
    @else
     <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                <a class="navbar-brand"><img src="{{asset('img/logoicon.png')}}" style="height: 30px"></a>
                </li>
            </ul>

            <!-- SEARCH FORM -->

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 ">
            <!-- Brand Logo -->

        <a href="/" class="brand-link text-center">

                <span class="brand-text  font-weight-bold">Maintenance TVE</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/" class="nav-link pere">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>

                        </li>
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link  pere">
                                <i class="nav-icon fas fa-gas-pump"></i>
                                <p>
                                    Gasoil
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/Gasoil" class="nav-link fils">
                                    <i class="fas fa-clipboard-list"></i>
                                        <p>Suivie</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Gasoil/create" class="nav-link fils">

                                        <i class="fas fa-plus-square"></i>

                                        <p>Ajouter</p>
                                    </a>
                                </li>
                            </ul>

                        </li>
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link  pere">
                                <i class="nav-icon fas fa-fill-drip"></i>
                                <p>
                                    Cuves
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/Cuve/" class="nav-link fils">
                                        <i class="fas fa-list"></i>
                                        <p>Liste des Cuves</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Cuve/create" class="nav-link fils">
                                        <i class="fas fa-plus-square"></i>
                                        <p>Ajouter</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Alimentation_Cuve" class="nav-link fils">
                                        <i class="fas fa-clipboard-list"></i>
                                        <p>Suivie</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Alimentation_Cuve/create" class="nav-link fils">

                                        <i class="fas fa-gas-pump"></i>

                                        <p>Alimenter</p>
                                    </a>
                                </li>

                            </ul>


                        </li>
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link  pere">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Kilometrage
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/Kilometrage/" class="nav-link fils">
                                        <i class="fas fa-clipboard-list"></i>
                                        <p>Suivie</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Kilometrage/create" class="nav-link fils">
                                        <i class="fas fa-plus-square"></i>
                                        <p>Ajouter</p>
                                    </a>
                                </li>
                            </ul>

                        </li>
                        <li class="nav-item has-treeview ">
                            <a class="nav-link  pere">
                                <i class="nav-icon fas fa-car-alt"></i>
                                <p>
                                    Vehicules
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/Vehicule" class="nav-link fils">
                                        <i class="fas fa-list"></i>
                                        <p>Liste Vehicules</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Modele" class="nav-link fils">
                                        <i class="fas fa-list"></i>

                                        <p>Liste Modeles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Marque" class="nav-link fils">
                                        <i class="fas fa-list"></i>

                                        <p>Liste Marques</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Modele/create" class="nav-link fils">
                                        <i class="fas fa-plus-square"></i>
                                        <p>Ajouter Modele</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Vehicule/create" class="nav-link fils">
                                        <i class="fas fa-plus-square"></i>
                                        <p>Ajouter Vehicule</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Marque/create" class="nav-link fils">
                                        <i class="fas fa-plus-square"></i>
                                        <p>Ajouter Marque</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/createstatsvehicule" class="nav-link fils">
                                        <i class="fas fa-clipboard-list"></i>
                                        <p>Suivie Vehicule</p>
                                    </a>
                                </li>

                                </li>

                                    </ul>






                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link  pere">
                                <i class="nav-icon fas fa-truck-moving"></i>
                                <p>
                                    Fournisseurs
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/Fournisseur/" class="nav-link fils">
                                        <i class="fas fa-list"></i>
                                        <p>Liste</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Cuve/create" class="nav-link fils">
                                        <i class="fas fa-plus-square"></i>
                                        <p>Ajouter</p>
                                    </a>
                                </li>

                            </ul>


                        </li>
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link  pere">
                                <i class="nav-icon fas fa-city"></i>
                                <p>
                                    Unités
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/Unite/" class="nav-link fils">
                                        <i class="fas fa-list"></i>
                                        <p>Liste</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/Unite/create" class="nav-link fils">
                                        <i class="fas fa-plus-square"></i>
                                        <p>Ajouter</p>
                                    </a>
                                </li>

                            </ul>


                        </li>
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link  pere">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    Utilisateurs
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/User/" class="nav-link fils">
                                        <i class="fas fa-list"></i>
                                        <p>Liste</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/User/create" class="nav-link fils">
                                        <i class="fas fa-plus-square"></i>
                                        <p>Ajouter</p>
                                    </a>
                                </li>

                            </ul>


                        </li>


                    </ul>

                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
     <div class="content-wrapper overflow-auto ">
         <!-- Content Header (Page header) -->
            <!-- /.content-header -->
            <main class="mt-6">
                @yield('content')
            </main>
            <!-- Main content -->
        </div>
    @endif

@endguest

</body>
<script>

    // ------------------ Table to Excel Sheet---------------------
    $("#buttonexcel").on('click', function () {
        $("#tableP").table2excel({
            name: "w1",
            filename: "suivie.xls",
            preserveColors: true
        })
    });
    // ------------------ Table to Excel Sheet end---------------------

</script>


</html>
