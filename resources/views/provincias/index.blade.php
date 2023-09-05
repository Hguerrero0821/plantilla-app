@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2"> <br> <br>
                <center><h3>Mantenimiento de Provincias</h3></center>

                <div class="panel panel-default">
                    <div class="card">
                        <div class="container"> <br>
                            <a href="{{route('provincias.create')}}" class="btn btn-info">Crear Provincia</a>
                            <table class="table table-striped mt-3">
                                <thead>
                                    <th style="display: none">ID</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                    <th></th>
                                </thead>

                                <tbody>
                                    @foreach ($provincias as $provincia)
                                    <tr>
                                        <td style="display: none">{{$provincia->id}}</td>
                                        <td>{{$provincia->name}}</td>
                                        <td>
                                            <a href="{{route('provincias.edit',$provincia->id)}}" class="btn btn-warning">
                                                Editar
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('provincias.destroy', ['provincia' => $provincia->id]) }}" method="POST">
                                                {{ @csrf_field() }} <!-- Agrega el campo de token CSRF -->
                                                @method('DELETE') <!-- Especifica el método DELETE -->
                                                <button class="btn btn-danger" type="submit">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
