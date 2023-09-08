@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="section-header">
                <center><h3>Profile del usuario</h3></center>
            </div>
            <div class="card card-body">
                <form action="{{route('profile.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <center>
                                <!-- Input de tipo imagen -->
                                <img src="{{$imagen->imagen ?? '' }}" class="user-image img-circle elevation-2"
                                alt="User Image" height="100" >

                                <input type="file" name="image" accept="image/*">
                                <input type="hidden" name="user_id" value="{{$usr->id ?? ''}}">
                            </center>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <center>
                                <label>Nombre del usuario:</label>
                                <input type="text" name="user_name" value="{{$usr->name ?? ''}}" class="form-control">
                            </center>
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <a href="{{route("home")}}" class="btn btn-secondary">
                                Cancel
                            </a>

                            <button class="btn btn-primary" type="submit">
                                Guardar
                            </button>

                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

@endsection
