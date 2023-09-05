@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2"> <br> <br>
                <div class="section-header">
                    <center><h3>Mantenimiento de Menús y Submenús</h3></center>
                </div>

                <div class="section-boy">
                    <div class="panel panel-default">
                        <div class="card">
                            <div class="container"> <br>
                                <form method="POST" action="{{route('menus.update',$menu->id)}}" >
                                    {{ @csrf_field() }} <!-- Agrega el campo de token CSRF -->
                                    @method('PUT')
                                    <div class="row">

                                       @include('menus._form')

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <submenu-component :data="{{json_encode($submenu)}}">
                                                </submenu-component>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <a href="{{ route('menus.index') }}" class="btn btn-secondary">Cancel</a>
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
