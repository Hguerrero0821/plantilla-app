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
                                <form method="POST" action="{{route('roles.update',$rol->id)}}" >
                                    {{ @csrf_field() }} <!-- Agrega el campo de token CSRF -->
                                    @method('PUT')
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
                                                        <td>
                                                            <input type="checkbox" name="usuarios[]"
                                                            value="{{$usr->id}}"
                                                            {{ in_array($usr->id, $usuariosSelected) ? 'checked' : '' }}>
                                                        </td>

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
                                                            <input type="checkbox" name="submenus[]"
                                                            value="{{$sub->id}}" {{ in_array($sub->id, $SubmenuSelected) ? 'checked' : '' }}>
                                                        </td>

                                                        <td>
                                                            <input type="hidden" value="0" name="{{'create['.$sub->id.']'}}">
                                                            <input type="checkbox" name="{{'create['.$sub->id.']'}}"
                                                            value="1"
                                                            {{ ($createSelected[$sub->id] ?? false) ? 'checked' : ''}}>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" value="0" name="{{'edit['.$sub->id.']'}}">
                                                            <input type="checkbox" name="{{'edit['.$sub->id.']'}}"
                                                            value="1"
                                                            {{ ($editSelected[$sub->id] ?? false) ? 'checked' : '' }}>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" value="0" name="{{'delete['.$sub->id.']'}}">
                                                            <input type="checkbox" name="{{'delete['.$sub->id.']'}}"
                                                            value="1"
                                                            {{ ($deleteSelected[$sub->id] ?? false) ? 'checked' : '' }}>
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
