@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2"> <br> <br>
                <div class="section-header">
                    <center><h3>Mantenimiento de Roles y Perfiles</h3></center>
                </div>

                <div class="section-boy">
                    <div class="panel panel-default">
                        <div class="card">
                            <div class="container"> <br>
                                <form method="POST" action="{{route('roles.store')}}" >
                                    {{ @csrf_field() }} <!-- Agrega el campo de token CSRF -->
                                    <div class="row">

                                        @include('roles._form')


                                        <div class="col-md-12 col-md-offset-2">

                                            <table class="table table-striped mt-3">
                                                <thead>
                                                    <th>Nombre del usuario</th>
                                                    <th>Email del usuario</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($usuarios as $usr)
                                                    <tr>
                                                        <td>{{$usr->name}}</td>
                                                        <td>{{$usr->email}}</td>
                                                        <td><input type="checkbox" name="usuarios[]" value="{{$usr->id}}"></td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-12 col-md-offset-2">

                                            <table class="table table-striped mt-3">
                                                <thead>
                                                    <th>Nombre del Submenu</th>
                                                    <th>Ruta</th>
                                                    <th>Create</th>
                                                    <th>Edit</th>
                                                    <th>Delete</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($submenus as $sub)
                                                    <tr>
                                                        <td>{{$sub->name}}</td>
                                                        <td>
                                                            <input type="checkbox" name="submenus[]" value="{{$sub->id}}">
                                                        </td>

                                                        <td>
                                                            <input type="checkbox" onclick="toggleValue(this, 'create_{{$sub->id}}')">
                                                            <input type="hidden" value="0" name="create[]" id="create_{{$sub->id}}">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" onclick="toggleValue(this, 'edit_{{$sub->id}}')">
                                                            <input type="hidden" value="0" name="edit[]" id="edit_{{$sub->id}}">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" onclick="toggleValue(this, 'delete_{{$sub->id}}')">
                                                            <input type="hidden" value="0" name="delete[]" id="delete_{{$sub->id}}">
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
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
                <script>
                    function toggleValue(checkbox, inputId) {
                        var input = document.getElementById(inputId);
                        if (checkbox.checked) {
                            input.value = "1";
                        } else {
                            input.value = "0";
                        }
                    }
                </script>
            </div>
        </div>
    </div>

@endsection
