@extends('layout')

@section('sidebar')
	@include('articles.sidebar')
@stop

@section('content')
  <div class=" col-md-10">
    <h4>Agregar un nuevo Artículo</h4>
      <form method="POST" action="/article/add">
        {{ csrf_field()}}
            
          <div class="form-group col-xs-2 col-sm-8">
            <label class="control-label">Departamento:</label>
            <select  id="department_id" class="form-control input-sm" name="department" required>
              <option value="">Seleccione el departamento</option>
                @foreach($departments as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                @endforeach
            </select>   
          </div>
          <div class="form-group col-xs-2 col-sm-8">
              <label class="control-label">Sección:</label>
                <select id="section" class="form-control input-sm" name="section" required>
                  <option>Seleccione primero el departamento</option>              
                </select>  
          </div> 
          <div class="form-group col-xs-2 col-sm-8 {{ $errors->has('code') ? ' has-error' : '' }}">
              <label class="control-label">Código:</label>
              <input type="text" class="form-control" name="code" value="{{ old('code') }}" placeholder="Ingrese el código del artículo" required autofocus>
              @if ($errors->has('code'))
                <span class="help-block">
                  <strong>{{ $errors->first('code') }}</strong>
                </span>
              @endif      
          </div>
          <div class="form-group col-xs-2 col-sm-8 {{ $errors->has('name') ? ' has-error' : '' }}">
              <label class="control-label">Nombre:</label>
              <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ingrese el nombre del artículo" required> @if ($errors->has('name'))
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
@stop

@section('script')
    <script>
      $('#department_id').on('change', function(e){
          var department_id = e.target.value;
          
          $.get('/article/sections/' + department_id, function(data){
            $('#section').empty();

            $.each(data, function(index, subcatObj){
              $('#section').append('<option value ="'+ subcatObj.id +'">'+subcatObj.name+'</option>');

            });
        });
      });
  </script>
@stop
