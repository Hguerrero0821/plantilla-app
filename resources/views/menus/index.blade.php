@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2"> <br> <br>
                <center><h3>Mantenimiento de Menús y Submenús</h3></center>

                <div class="panel panel-default">
                    <div class="card">
                        <div class="container"> <br>
                            <a href="{{route('menus.create')}}" class="btn btn-info">Crear Menu</a>
                            <table class="table table-striped mt-3">
                                <thead>
                                    <th style="display: none">ID</th>
                                    <th>Nombre</th>
                                    <th>Description</th>
                                    <th>Acciones</th>
                                    <th></th>
                                </thead>

                                <tbody>
                                    @foreach ($menus as $menu)
                                    <tr>
                                        <td style="display: none">{{$menu->id}}</td>

                                        <td>
                                            <a
                                            data-toggle="collapse"
                                            href="#submenuCollapse{{$menu->id}}">
                                                {{$menu->name}}
                                            </a>
                                            <div class="collapse" id="submenuCollapse{{$menu->id}}">
                                                <div class="flex">
                                                    <div class="card card-body">
                                                        <h6>Submenus:</h6>
                                                        @foreach ( $menu->submenu as $item )
                                                        <li>
                                                            {{$item->name}}
                                                        </li>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                        </td>

                                        <td>{{$menu->description}}</td>
                                        <td>
                                            <a href="{{route('menus.edit',$menu->id)}}" class="btn btn-warning">
                                                Editar
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('menus.destroy', ['menu' => $menu->id]) }}" method="POST">
                                                {{ @csrf_field() }} <!-- Agrega el campo de token CSRF -->
                                                @method('DELETE') <!-- Especifica el método DELETE -->

                                                <button class="btn btn-danger" type="submit"
                                                onclick="return confirm('Desea eliminar este menu?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                             {{ $menus->links()}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
