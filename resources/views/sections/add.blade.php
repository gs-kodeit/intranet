@extends('layout')

@section('panel')
  @include('dashboard')
@stop


@section('sidebar')
	@include('sections.sidebar')	
@stop

@section('content')
    <div class="row">
      <div class="col-sm-10">
        <h4>Agregar una nueva Sección</h4>
        <form method="POST" action="/section/add" id="section">
          {{ csrf_field()}}

          <div class="form-group col-xs-2 col-sm-8 {{ $errors->has('department') ? ' has-error' : '' }}">
            <label>Departamento</label>
            <select  id="department" class="form-control input-sm" name="department" required>
              <option value="0" selected disabled>Seleccione el departamento</option>
              @foreach($departments as $department)
                  <option value="{{ $department->id }}" >{{$department->name}}</option>
              @endforeach
            </select>
            @if ($errors->has('department'))
              <span class="help-block">
                <strong>{{ $errors->first('department') }}</strong>
              </span>
            @endif          
          </div>

          <div class="form-group col-xs-2 col-sm-8 {{ $errors->has('code') ? ' has-error' : '' }}">
              <label class="control-label">Código:</label>
              <div>
                <input type="text" class="form-control" name="code" value="{{ old('code') }}" placeholder="Ingrese el código de la sección" required autofocus>
                @if ($errors->has('code'))
                <span class="help-block">
                    <strong>{{ $errors->first('code') }}</strong>
                </span>
              @endif
              </div>                        
          </div>

          <div class="form-group col-xs-2 col-sm-8 {{ $errors->has('name') ? ' has-error' : '' }}">
              <label class="control-label">Nombre:</label>
              <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ingrese el nombre de la sección" required>
              @if ($errors->has('name'))
                <span class="help-block">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
          </div>

          <div class="form-group col-xs-2 col-sm-8" align="right">
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>          
        </form>
      </div>
    </div>
@stop