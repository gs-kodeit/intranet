@extends('layout')

@section('form')
	<div class=" col-md-12">
        <form method="POST" action="/request/add">
        	<div class="form-group col-xs-2 col-sm-12">
                <label class="control-label col-md-2">Tipo de Movimiento:</label>
                <div class="col-md-10">
                    <select  id="operation" class="form-control input-sm" name="operation" required>
                      <option selected disabled>Seleccione el tipo de movimiento</option>
                      <option value="Entrada">Entrada</option>
                      <option value="Salida">Salida</option>
                    </select>
                </div>          
            </div>
            <div class="form-group col-xs-2 col-sm-12">
                <label class="control-label col-md-2">Categoría:</label>
                <div class="col-md-10">
                   <select id="type" class="form-control input-sm" name="type" required>
                      <option selected disabled>Seleccione la categoría</option> 
                      <option value="Persona">Persona</option>
                      <option value="Material">Material</option>             
                      <option value="Ambos">Persona y Material</option>
                    </select>        
                </div>
            </div>
            <div class="form-group col-xs-2 col-sm-12 {{ $errors->has('destination') ? ' has-error' : '' }}">
                <label class="control-label col-md-2">Destino:</label>
                <div class="col-md-10"> 
                  <input type="text" class="form-control" name="destination" id="destination" placeholder="Ingrese el destino." value="{{ old('destination') }}" required>
                    @if ($errors->has('destination'))
                        <span class="help-block">
                            <strong>{{ $errors->first('destination') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
			<div class="form-group col-xs-2 col-sm-12 {{ $errors->has('destination') ? ' has-error' : '' }}">
                <label class="control-label col-md-2">Hora:</label>
                <div class="col-md-2">
                	<select name="hour" class="form-control input-sm">
                		<option selected disabled>Hora</option>
                		@for($i = 1; $i <= 12; $i++)
                			<option value="{{ $i }}">{{ $i }}</option>
                		@endfor
                	</select>                		
                </div>
                <div class="col-md-2">
                	<select name="minute" class="form-control input-sm">
                		<option selected disabled>Minutos</option>
                		@for($i = 0; $i <=59 ; $i++)
                			<option value="{{ $i }}">{{ $i }}</option>
                		@endfor
                	</select>                		
                </div>
                <div class="col-md-2">
                	<select name="ampm" class="form-control input-sm">
                		<option value="AM">AM</option>
                		<option value="PM">PM</option>                		
                	</select>                		
                </div>	 	            
			</div> 
			<div class="form-group col-xs-2 col-sm-12" id="person" style="display: none">
				<h4><span class="label label-default">Datos de la persona</span></h4>
				<label class="control-label col-md-2">Nombre:</label>
				<div class="col-md-10"> 
                 	<input type="text" class="form-control" name="person_name" id="person_name" placeholder="Ingrese el nombre de la persona." value="{{ old('person_name') }}" required>
                </div>
                <div class="row">
                	
                </div>
                <label class="control-label col-md-2">Cédula:</label>
				<div class="col-md-10"> 
                 	<input type="text" class="form-control" name="person_id" id="person_id" placeholder="Ingrese la cédula de la persona." value="{{ old('person_id') }}" required>
                </div>
                <label class="control-label col-md-2">Ocupación:</label>
				<div class="col-md-10"> 
                 	<input type="text" class="form-control" name="person_occupation" id="person_occupation" placeholder="Ingrese la ocupación de la persona." value="{{ old('person_occupation') }}" required>
                </div>                
			</div>
			<div class="form-group col-xs-2 col-sm-12" id="vehicle" style="display: none">
				<h4><span class="label label-default">Datos del vehículo</span></h4>
				<label class="control-label col-md-2">Tipo de vehículo:</label>
				<div class="col-md-10"> 
                 	<input type="text" class="form-control" name="vehicle" id="vehicle" placeholder="Ingrese el tipo de vehículo." value="{{ old('vehicle') }}" required>
                </div>
                <label class="control-label col-md-2">Placa:</label>
				<div class="col-md-10"> 
                 	<input type="text" class="form-control" name="vehicle_plate" id="vehicle_plate" placeholder="Ingrese la placa del vehículo." value="{{ old('vehicle_plate') }}" required>
                </div>
			</div>
			<div class="form-group col-xs-2 col-sm-12" id="material" style="display: none">
				<h4><span class="label label-default">Datos del material</span></h4>
				<label class="control-label col-md-2">Tipo de material:</label>
				<div class="col-md-10"> 
                 	<input type="text" class="form-control" name="material_type" id="material_type" placeholder="Ingrese el tipo de marterial." value="{{ old('material_type') }}" required>
                </div>
                <label class="control-label col-md-2">Placa:</label>
				<div class="col-md-10"> 
                 	<input type="text" class="form-control" name="material_quantity" id="material_quantity" placeholder="Ingrese la cantidad de material." value="{{ old('material_quantity') }}" required>
                </div>
			</div>
            <div class="form-group col-xs-2 col-sm-12" align="right">
                <button type="submit" class="btn btn-primary">Enviar formulario</button>
            </div>
        </form>
    </div>
@stop

@section('script')
	<script type="text/javascript">
		$('#type').on('change',function(){

			selection = $(this).val()
		    switch(selection)
		    {
		       	case 'Persona':
		       		$("#vehicle").hide()
		        	$("#person").show()
		           	$("#vehicle").show()
		           	$('#material').hide()		           	
		           	break;
		       	case 'Material':
		       		$("#vehicle").hide()
		           	$('#material').show()
		           	$("#vehicle").show()
		           	$("#person").hide()		           	
		           	break;
		        case 'Ambos':
		        	$("#vehicle").hide()
		        	$("#person").show()
		       	 	$('#material').show()
		        	$("#vehicle").show()
		        	break;
		   	}
		});
	</script>
@stop