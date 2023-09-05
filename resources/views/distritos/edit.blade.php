@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2"> <br> <br>
                <div class="section-header">
                    <center><h3>Mantenimiento de Distritos</h3></center>
                </div>

                <div class="section-boy">
                    <div class="panel panel-default">
                        <div class="card">
                            <div class="container"> <br>
                                <form method="POST" action="{{route('distritos.update', $distrito->id)}}" >
                                    {{ @csrf_field() }} <!-- Agrega el campo de token CSRF -->
                                    @method('PUT')
                                    <div class="row">

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Name:</label>
                                                <input type="text" name="name" class="form-control"
                                                value="{{$distrito->name}}" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <a href="{{ route('distritos.index') }}" class="btn btn-secondary">Cancel</a>
                                                <button type="submit" class="btn btn-primary">
                                                    Guardar
                                                </button>
                                            </div>
                                        </div>

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
