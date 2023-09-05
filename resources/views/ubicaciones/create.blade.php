@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2"> <br> <br>
                <div class="section-header">
                    <center><h3>Mantenimiento de Provincias Corregimientos y Distritos</h3></center>
                </div>

                <div class="section-boy">
                    <div class="panel panel-default">
                        <div class="card">
                            <div class="container"> <br>
                                <form method="POST" action="{{route('ubicaciones.store')}}" >
                                    {{ @csrf_field() }} <!-- Agrega el campo de token CSRF -->
                                    <div class="row">

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label>Nombre de la provincia:</label>

                                                <input type="text" class="form-control" name="provincia">

                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <corregimientos-component>
                                                </corregimientos-component>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <a href="{{ route('ubicaciones.index') }}" class="btn btn-secondary">Cancel</a>
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
