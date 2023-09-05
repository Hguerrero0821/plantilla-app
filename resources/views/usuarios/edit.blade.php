@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2"> <br> <br>
                <div class="section-header">
                    <center><h3>Mantenimiento de usuarios</h3></center>
                </div>

                <div class="section-boy">
                    <div class="panel panel-default">
                        <div class="card">
                            <div class="container"> <br>
                                <form method="POST" action="{{route('usuarios.update', $usr->id)}}" >
                                    {{ @csrf_field() }} <!-- Agrega el campo de token CSRF -->
                                    @method('PUT')
                                    <div class="row">

                                        @include('usuarios._form')

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
