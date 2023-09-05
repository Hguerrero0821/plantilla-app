@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2"> <br> <br>

                <div class="panel panel-default">
                    <div class="card">
                        <div class="container">
                            <form method="POST" action="{{ route('notification.store') }}">
                                {{ @csrf_field() }}
                                <div class="form-group">
                                    <label>Para quien es el mensaje:</label>
                                    <select name="user_id" class="form-control">
                                        <option value="0">Seleccione un usuario</option>
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">

                                    <textarea name="body" class="form-control" placeholder="Escribe aqui tu mensaje"></textarea>
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

@endsection
