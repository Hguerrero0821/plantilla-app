@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2"> <br> <br>
                <center><h3>Mantenimiento de notificaciones</h3></center>

                <div class="panel panel-default">
                    <div class="card">
                        <div class="container"> <br>
                            <a href="{{route('notification.create')}}" class="btn btn-info">Mandar un mensaje</a>
                            <table class="table table-striped mt-3">
                                <thead>
                                    <th style="display: none">ID</th>
                                    <th>Usuario remitente</th>
                                    <th>Usuario receptor</th>
                                    <th>Mensaje</th>
                                    <th>acciones</th>
                                    <th></th>
                                </thead>

                                <tbody>
                                    @foreach ($notification as $noty)
                                    <tr>
                                        <td style="display: none">{{$noty->id}}</td>
                                        <td>{{$noty->user_name}}</td>
                                        <td>{{$noty->recipient_id}}</td>
                                        <td>{{$noty->body}}</td>
                                        <td>
                                            <a href="{{route('notification.edit',$noty->id)}}" class="btn btn-warning">
                                                Editar
                                            </a>
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
