@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2"> <br> <br>
                <div class="section-header">
                    <center><h3>Mantenimiento de notificaciones</h3></center>
                </div>

                <div class="section-boy">
                    <div class="panel panel-default">
                        <div class="card">
                            <div class="container"> <br>
                                <form method="POST" action="{{route('notification.update',$notification->id)}}" >
                                    {{ @csrf_field() }} <!-- Agrega el campo de token CSRF -->
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Para quien es el mensaje:</label>
                                        <select name="user_id" class="form-control">
                                            <option value="0">Seleccione un usuario</option>
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}"
                                                    {{$notification->user_id == $user->id ? 'selected': '' }}>
                                                    {{$user->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">

                                        <textarea name="body" class="form-control"
                                        value = "{{$notification->body}}"
                                         placeholder="Escribe aqui tu mensaje"></textarea>
                                    </div>

                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Enviar
                                        </button>
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
