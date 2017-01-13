@extends('layout')

@section('panel')
    @include('dashboard')
@stop

@section('sidebar')
	@include('departments.sidebar')	
@stop

@section('modal-delete')
	<div id="myModalDelete" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title">Eliminar departamento</h4>
				</div>
				<div class="modal-body">
					<p>¿Está seguro que desea eliminar el departamento?</p>
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
        			<h4 class="modal-title">Editar departamento</h4>
				</div>
				
				<form method="POST" action="" id="edit">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
						<div class="modal-body form-group">
				            <label class="control-label">Nombre:</label>
				            <div class="form-group">
				                <textarea name="name" id="name" class="form-control" autofocus>Nombre</textarea>
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
        			<h4 class="modal-title">Secciones</h4>
				</div>				
				<div class="modal-body">
					<table id="departmentTable" class="table table-striped">
					    <thead>
					      <tr>
					        <th>Código</th>
					        <th>Sección</th>
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
		      	</tr>
		    </thead>
		    <tbody>
		    	@foreach($departments as $department)
		      		<tr id="department{{ $department->id }}">
		        		<td><a href="#" data-toggle="modal" data-target="#myModalShow" data-id="{{$department->id}}">{{ $department->code }}</a></td>
			        	<td><span id="{{ $department->id }}">{{ $department->name }}</span></td>		        	
			        	<td align="right"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$department->id}}"><span class="glyphicon glyphicon-pencil"></span></button>
			        	<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$department->id}}"><span class="glyphicon glyphicon-trash"></span></button>
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
		  	var department_id = button.data('id')

	  		$.get('/department/getDepartment/' + department_id, function(response){
				$('label[id="name"]').text(response.name)
	  		})
	  		$('form[id="delete"]').attr('action','department/' + department_id)
		});

		$('#myModalEdit').on('show.bs.modal', function (event) {
		  	var button = $(event.relatedTarget) // Button that triggered the modal
		  	var department_id = button.data('id')

		  	$.get('/department/getDepartment/' + department_id, function(response){
  				$('textarea[id="name"]').text(response.name)
		  	})
		  	$('form[id="edit"]').attr('action','department/' + department_id)
		});

		$('#myModalShow').on('show.bs.modal', function (event) {
		  	var button = $(event.relatedTarget) // Button that triggered the modal
		  	var department_id = button.data('id')

		  	$.get('/article/sections/' + department_id, function(data){
            	$('#body').empty();
            	$.each(data, function(index, subcatObj){
              		$('#departmentTable').append('<tr><td>'+ subcatObj.code +'</td><td>' + subcatObj.name + '</td></tr>');
            	});
        	});
		});
	</script>
@stop
	