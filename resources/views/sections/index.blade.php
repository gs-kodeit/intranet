@extends('layout')

@section('sidebar')
	@include('sections.sidebar')	
@stop

@section('modal-delete')
	<div id="myModalDelete" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title">Eliminar sección</h4>
				</div>
				<div class="modal-body">
					<p>¿Está seguro que desea eliminar la sección?</p>
					<label id="name">Nombre</label>
				</div>
				<div class="modal-footer ">						
					<form method="POST" action="" id="delete">
						{{ method_field('DELETE') }}
						{{ csrf_field() }}
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-danger btn-delete">Eliminar</button>
					</form>
				</div>
			</div>			
		</div>		
	</div>
@stop

@section('modal-edit')
	<div id="myModalEdit" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title">Editar Sección</h4>
				</div>
				
				<form method="POST" action="#" id="edit">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
						<div class="modal-body">
							<div class="form-group">
					            <label class="control-label">Nombre:</label>
					            <div class="form-group">
					                <textarea name="name" id="name" class="form-control" autofocus>Nombre</textarea>
					            </div>
					        </div>
				            <div class="form-group">
			                	<label class="control-label">Departamento:</label>
					            <select  id="department" class="form-control input-sm" name="department">
					            	<option value="0" selected disabled>Seleccione el departamento</option>
					              	@foreach($departments as $department)
					                 	<option value="{{$department->id}}">{{$department->name}}</option>
					              	@endforeach
					            </select>        
			                </div>
				        </div>
				        <div class="modal-footer form-group">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-primary btn-edit">Guardar</button>
						</div>
			    </form> 		
			</div>			
		</div>		
	</div>
@stop

@section('modal-show')
	<div id="myModalShow" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title">Artículos</h4>
				</div>				
				<div class="modal-body">
					<table id="sectionsTable" class="table table-striped">
					    <thead>
					      <tr>
					        <th>Código</th>
					        <th>Artículo</th>
					      </tr>
					    </thead>
					    <tbody id="body">					    		     
					    </tbody>
					 </table>
				</div>
		        <div class="modal-footer form-group">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>		
			</div>			
		</div>		
	</div>
@stop

@section('content')
	<div class="col-md-11">
		<table class="table table-striped">
		    <thead>
		      <tr>	      	
		        <th>Código</th>
		        <th>Nombre</th>
		        <th>Departamento</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($sections as $section)
		      		<tr>	      			
		        		<td><a href="#" data-toggle="modal" data-target="#myModalShow" data-id="{{$section->id}}">{{ $section->code }}</a></td>
			        	<td>{{ $section->name }}</td>
			        	<td>{{ $section->department->name }}</td>
			        	<td align="right"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$section->id}}"><span class="glyphicon glyphicon-pencil"></span></button>
			        	<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$section->id}}"><span class="glyphicon glyphicon-trash"></span></button>
			        	</td>
		     		</tr>
		     	@endforeach	     
		    </tbody>
		 </table>
	</div>
@stop

@section('script')
	<script type="text/javascript">
		$('#myModalDelete').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
		  	var section_id = button.data('id')

		  	$.get('/section/getSection/' + section_id, function(response){
  				$('label[id="name"]').text(response.name)
		  	})
		  	$('form[id="delete"]').attr('action','section/' + section_id)
		});	

		$('#myModalEdit').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var section_id = button.data('id')

			$.get('/section/getSection/' + section_id, function(response){
  				$('textarea[id="name"]').text(response.name)
		  	})
		  	$('form[id="edit"]').attr('action','section/' + section_id)
		});	

		$('#myModalShow').on('show.bs.modal', function (event) {
		  	var button = $(event.relatedTarget) // Button that triggered the modal
		  	var section_id = button.data('id')

		  	$.get('/section/articles/' + section_id, function(data){
            	$('#body').empty();
            	$.each(data, function(index, subcatObj){
              		$('#sectionsTable').append('<tr><td>'+ subcatObj.code +'</td><td>' + subcatObj.name + '</td></tr>');
            	});
        	});
		});
	</script>
@stop