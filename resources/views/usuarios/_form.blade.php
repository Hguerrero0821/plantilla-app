<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" value="{{$usr->name}}">
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <label>E-mail:</label>
        <input type="email" name="email" class="form-control" value="{{$usr->email}}">
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <label>Password:</label>
        <input type="password" name="password" class="form-control">
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <label>Confirm Password:</label>
        <input type="password" name="confirm-password" class="form-control">
    </div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
    </div>
</div>
