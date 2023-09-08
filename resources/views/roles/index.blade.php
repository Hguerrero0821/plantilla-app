@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2"> <br> <br>
                <center><h3>Mantenimiento de Roles y Perfiles</h3></center>

                <div class="panel panel-default">
                    <div class="card">
                        <div class="container"> <br>
                            <a href="{{route('roles.create')}}" class="btn btn-info">Crear Rol</a>
                            <table class="table table-striped mt-3">
                                <thead>
                                    <th style="display: none">ID</th>
                                    <th>Nombre</th>
                                    <th>Description</th>
                                    <th>Acciones</th>
                                    <th></th>
                                </thead>

                                <tbody>
                                    @foreach ($roles as $rol)
                                    <tr>
                                        <td style="display: none">{{$rol->id}}</td>
                                            <td>
                                                <a data-toggle="collapse"
                                                    href="#collapseExample{{$rol->id}}"
                                                    aria-expanded="false"
                                                    aria-controls="collapseExample {{$rol->id}}">
                                                    {{$rol->name}}
                                                </a>

                                                <div class="collapse" id="collapseExample{{$rol->id}}">

                                                    <div class="card card-body">
                                                        <h6>
                                                            <b>Usuarios</b>
                                                        </h6>
                                                            @foreach ( $rol->rolesUsuarios as $item )
                                                                <li>
                                                                    {{ $item->usuario->name }}
                                                                </li>
                                                            @endforeach ()

                                                        </div>

                                                        <div class="card card-body">
                                                            <table>
                                                                <thead>
                                                                    <th>
                                                                        <b>Submenus</b>
                                                                    </th>
                                                                    <th>
                                                                        <b>Permisos</b>
                                                                    </th>

                                                                </thead>

                                                                <tbody>

                                                                    @foreach ( $rol->rolesSubmenus as $item )

                                                                    <tr>
                                                                        <td>
                                                                            <li>
                                                                                {{ $item->submenus->name }}

                                                                            </li>
                                                                        </td>

                                                                        <td>
                                                                            <b>{{ $item->create ? 'Crear' : ''}}</b>
                                                                            <b>{{ $item->edit ? '  Editar' : ''}} </b>
                                                                            <b>{{ $item->delete ? ' Eliminar' : ''}}</b>
                                                                        </td>
                                                                    </tr>

                                                                    @endforeach
                                                                </tbody>
                                                            </table>

                                                        </div>

                                                </div>
                                            </td>

                                            <td>{{$rol->description}}</td>
                                            <td>
                                                <a href="{{route('roles.edit',$rol->id)}}" class="btn btn-warning">
                                                    Editar
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('roles.destroy', ['role' => $rol->id]) }}" method="POST">
                                                    {{ @csrf_field() }} <!-- Agrega el campo de token CSRF -->
                                                    @method('DELETE') <!-- Especifica el método DELETE -->

                                                    <button class="btn btn-danger" type="submit"
                                                    onclick="return confirm('Desea eliminar este rol?')">
                                                        Eliminar
                                                    </button>
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
