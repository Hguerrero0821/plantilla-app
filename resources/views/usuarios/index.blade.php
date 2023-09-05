@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2"> <br> <br>
                <center><h3>Mantenimiento de usuarios</h3></center>

                <div class="panel panel-default">
                    <div class="card">
                        <div class="container"> <br>
                            {{-- <div class="flex items-center justify-between">

                            </div> --}}
                            <a href="{{route('usuarios.create')}}" class="btn btn-info">Crear usuario</a>
                            <table class="table table-striped mt-3">
                                <thead>
                                    <th style="display: none">ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Acciones</th>
                                    <th></th>
                                </thead>

                                <tbody>
                                    @foreach ($user as $usr)
                                    <tr>
                                        <td style="display: none">{{$usr->id}}</td>
                                        <td>{{$usr->name}}</td>
                                        <td>{{$usr->email}}</td>
                                        <td>
                                            <a href="{{route('usuarios.edit',$usr->id)}}" class="btn btn-warning">
                                                Editar
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('usuarios.destroy', ['usuario' => $usr->id]) }}" method="POST">
                                                {{ @csrf_field() }} <!-- Agrega el campo de token CSRF -->
                                                @method('DELETE') <!-- Especifica el método DELETE -->

                                                <button class="btn btn-danger" type="submit"
                                                onclick="return confirm('Desea eliminar este usuario?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $user->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
