<x-laravel-ui-adminlte::adminlte-layout>
    <head>
        {{-- @notifyCss --}}

    </head>
    <body class="hold-transition sidebar-mini layout-fixed">

        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }

        </script>
        <div class="wrapper">
            <!-- Main Header -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                </ul>
                {{-- Notificaciones del usuario  --}}
                {{-- {{$alert}} --}}
                    <ul class="navbar-nav ml-auto">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" style="border-radius: 100%">
                                Notification <span class="badge">{{$noty}}</span>
                            </button>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                @foreach ($noty_body as $item)
                                    <form action="{{ route('notification.update', ['notification' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT') <!-- Cambia 'PUT' al método HTTP correcto para tu caso -->

                                        @if ( $alert != null )

                                        @foreach ($alert as $alt)
                                            <button type="submit" class="dropdown-item" style="border: none; background-color: transparent;">
                                                <b>{{ $alt->usuarios->name }} </b> {{$alt->body}}
                                            </button>
                                        @endforeach

                                        @endif

                                        <button type="submit" class="dropdown-item" style="border: none; background-color: transparent;">
                                            <b>{{ $item->user_name }} te ha enviado un mensaje:</b>
                                            {{ $item->body }}
                                        </button>

                                    </form>
                                @endforeach
                            </div>
                        </div>
                {{-- Notificaciones del usuario  --}}

                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="{{$imagen->imagen ?? '' }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                            <span class="d-none d-md-inline">{{ Auth::user()->name ?? ''}}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                <img src="{{$imagen->imagen ?? '' }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                                <p>
                                    {{ Auth::user()->name ?? ''}}
                                    <small> {{ Auth::user()->email }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">

                                <a href="{{route('profile.create')}}" class="btn btn-default btn-flat">
                                    Profile
                                </a>


                                <a href="#" class="btn btn-default btn-flat float-right"
                                    onclick="confirmLogout(event)">
                                    Sign out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                                <script>
                                    function confirmLogout(event) {
                                        event.preventDefault();

                                        if (confirm('¿Estás seguro de que deseas cerrar la sesión?')) {
                                            // Si el usuario confirma, envía el formulario de logout
                                            document.getElementById('logout-form').submit();
                                        } else {
                                            // Si el usuario cancela, no hace nada
                                        }
                                    }
                                </script>

                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <!-- Left side column. contains the logo and sidebar -->
            @include('layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div id="app">
                    @yield('content')
                </div>

            </div>

            <!-- Main Footer -->
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.1.0
                </div>
                <strong>Copyright &copy; 2014-2023 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
                reserved.
            </footer>
        </div>


    </body>
</x-laravel-ui-adminlte::adminlte-layout>
