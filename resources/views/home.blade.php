@extends('layout')

@section('form')
    <div class=" col-md-12">
        <form method="POST" action="/request/add">
            {{ csrf_field()}}
            <div class="form-group col-xs-2 col-sm-12 {{ $errors->has('article_name') ? ' has-error' : '' }}">
                <label class="control-label col-md-2">Nombre del artículo:</label>
                <div class="col-md-10"> 
                  <input type="text" class="form-control" name="article_name" id="articulo" placeholder="Utilizar características puntuales que ayuden a identificar el artículo rápidamente.(Ej. 'RAMPLUG EXPANSIVO 5/16')" value="{{ old('article_name') }}" required>
                    @if ($errors->has('article_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('article_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>          
            <div class="form-group col-xs-2 col-sm-12">
                <label class="control-label col-md-2">Tipo de Uso:</label>
                <div class="col-md-10"> 
                  <div class="radio">
                        <label class="control-label"><input type="radio" name="usage" value="SERVICIO">SERVICIO</label>
                    </div>
                </div>
            </div>
            <div class="form-group col-xs-2 col-sm-12">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="radio">
                        <label class="control-label"><input type="radio" name="usage" value="CONSUMO">CONSUMO</label>
                    </div>
                </div>
            </div>          
            <div class="form-group col-xs-2 col-sm-12">
                <label class="control-label col-md-2">Detalles:</label>
                <div class="col-md-10">
                  <div class="checkbox">
                    <label><input type="checkbox" name="generic">Artículo Genérico</label>
                  </div>
                </div>
            </div>    
            <div class="form-group col-xs-2 col-sm-12">    
                <label class="control-label col-md-2">Unidad de Medida:</label>            
                <div class="col-md-10">
                    <div class="radio">
                        <label class="control-label"><input type="radio" value="KG" name="unit">Kilogramo (KG)</label>
                    </div>
                </div>
            </div>
            <div class="form-group col-xs-2 col-sm-12">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="radio">
                        <label class="control-label"><input type="radio" value="LTR" name="unit">Litro (LTR)</label>
                    </div>
                </div>
            </div>
            <div class="form-group col-xs-2 col-sm-12">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="radio">
                        <label class="control-label"><input type="radio" value="UND" name="unit">Unidad (UND)</label>
                    </div>
                </div>                
            </div>
            <div class="form-group col-xs-2 col-sm-12">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="radio">
                        <label class="control-label"><input type="radio" value="MTR" name="unit">Metro Lineal (MTR)</label>
                    </div>
                </div>
            </div>
            <div class="form-group col-xs-2 col-sm-12">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="radio">
                        <label class="control-label"><input type="radio" name="unit" value="otro">Otro</label>
                    </div>
                    <div>
                        <input type="text" class="form-control" for="otro" name="unit_text" placeholder="Ingrese la unidad de medida">
                    </div>
                </div>
            </div> 
            <div class="form-group col-xs-2 col-sm-12 {{ $errors->has('explanation') ? ' has-error' : '' }}">
                <label class="control-label col-md-2">Explicación:</label>
                <div class="col-md-10">
                    <textarea class="form-control" rows="5" id="explicacion" name="explanation" placeholder="Describa de manera simple y con sus propias palabras la finalidad y uso de este artículo" value="{{ old('explanation') }}" required></textarea>
                    @if ($errors->has('explanation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('explanation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group col-xs-2 col-sm-12">
                <label class="control-label col-md-2">Departamento:</label>
                <div class="col-md-10">
                    <select  id="department_id" class="form-control input-sm" name="department" required>
                      <option value="">Seleccione el departamento</option>
                      @foreach($departments as $department)
                          <option value="{{$department->id}}">{{$department->name}}</option>
                      @endforeach
                    </select>
                </div>          
            </div>
            <div class="form-group col-xs-2 col-sm-12">
                <label class="control-label col-md-2">Sección:</label>
                <div class="col-md-10">
                   <select id="section" class="form-control input-sm" name="section" required>
                      <option>Seleccione primero el departamento</option>              
                    </select>        
                </div>
            </div> 
            <div class="form-group col-xs-2 col-sm-12" align="right">
                <button type="submit" class="btn btn-primary">Enviar formulario</button>
            </div>
        </form>
    </div>    
@stop

@section('script')
    <script>
    $('#department_id').on('change', function(e){
        console.log(e);

        var department_id = e.target.value;

        //ajax
        $.get('/article/sections/' + department_id, function(data){
            console.log(data);

            $('#section').empty();

            $.each(data, function(index, subcatObj){

              $('#section').append('<option value ="'+ subcatObj.id +'">'+subcatObj.name+'</option>');

            });
        });
    });
  </script>
@stop