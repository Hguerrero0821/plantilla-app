@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2"> <br> <br>
                <center><h3>Mantenimiento de Auditorias</h3></center>

                <div class="panel panel-default">
                    <div class="card">
                        <div class="container"> <br>

                            <form action="" method="GET" class="formulario-busqueda">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Nombre de usuario:</label>
                                        <input type="text" name="nombre" value="{{ old('nombre') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Por evento:</label>
                                        <input type="text" name="evento" value="{{ old('evento') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Fecha desde:</label>
                                        <input type="date" name="desde" value="{{ old('desde') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Fecha hasta:</label>
                                        <input type="date" name="hasta" value="{{ old('hasta') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-success">Filtrar</button>
                                        <a class="btn btn-danger" href="{{ route('auditorias.index') }}">Borrar Filtro</a>
                                    </div>
                                </div>

                            </form>

                            <table class="table table-responsive">
                                <thead>
                                    <th style="display: none">ID</th>
                                    <th>Tipo de Usuario</th>
                                    <th>Usuario</th>
                                    <th>Evento</th>
                                    <th>Tipo de Auditoria</th>
                                    <th>ID de la Auditoria</th>
                                    <th>Valores Antiguos</th>
                                    <th>Valores Nuevos</th>
                                    <th>Url</th>
                                    <th>IP Address</th>
                                    <th>User Agent</th>
                                    <th>Fecha de creado</th>
                                    <th>Fecha de actualizado</th>
                                </thead>

                                <tbody>
                                    @foreach ($auditorias as $audit)
                                    <tr>
                                        <td style="display: none">{{$audit->id}}</td>
                                        <td>{{$audit->user_type}}</td>
                                        <td>{{$audit->usuarios->name}}</td>
                                        <td>{{$audit->event}}</td>
                                        <td>{{$audit->auditable_type}}</td>
                                        <td>{{$audit->auditable_id}}</td>
                                        <td><code>{{ json_encode($audit->old_values, JSON_PRETTY_PRINT) }}</code></td>
                                        <td><code>{{ json_encode($audit->new_values, JSON_PRETTY_PRINT) }}</code></td>
                                        <td>{{$audit->url}}</td>
                                        <td>{{$audit->ip_address}}</td>
                                        <td>{{$audit->user_agent}}</td>
                                        <td>{{$audit->created_at}}</td>
                                        <td>{{$audit->updated_at}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $auditorias->links() }}

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
