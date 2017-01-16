@extends('layout')

@section('sidebar')
	@include('articles.sidebar')	
@stop

@section('modal-delete')
	<div id="myModalDelete" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title">Eliminar artículo</h4>
				</div>
				<div class="modal-body">
					<p>¿Está seguro que desea eliminar el artículo?</p>
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
        			<h4 class="modal-title">Editar Artículo</h4>
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
			                <div class="form-group">
						        <label class="control-label">Sección:</label>
						        	<select id="section" class="form-control input-sm" name="section">
						            	<option value="0" selected disabled>Seleccione primero el departamento</option>              
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

@section('content')
	<div class="col-md-11">
		<table class="table table-striped">
		    <thead>
		      <tr>
		      	<th>Código</th>
		        <th>Nombre</th>
		      	<th>Departamento</th>
		      	<th>Sección</th>		        
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($articles as $article)
		      		<tr>
		      			<td>{{ $article->code }}</td>
			        	<td>{{ $article->name }}</td>
			        	<td>{{ $article->department->name }}</td>
			        	<td>{{ $article->section->name }}</td>		      			
		      			<td align="right"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$article->id}}"><span class="glyphicon glyphicon-pencil"></span></button>
			        	<button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$article->id}}"><span class="glyphicon glyphicon-trash"></span></button>
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
		  	var article_id = button.data('id')

		  	$.get('/article/getArticle/' + article_id, function(response){
		  		console.log(response);
  				$('label[id="name"]').text(response.code + ' ' + response.name)
		  	})
		  	$('form[id="delete"]').attr('action','article/' + article_id)
		});	

		$('#myModalEdit').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var article_id = button.data('id')

			$.get('/article/getArticle/' + article_id, function(response){
  				$('textarea[id="name"]').text(response.name)
		  	})
		  	$('form[id="edit"]').attr('action','article/' + article_id)
		});

		$('#department').on('change', function(e){
        	var department_id = e.target.value;

	        $.get('/article/ajax-section/' + department_id, function(data){

	            $('#section').empty();
	            $.each(data, function(index, subcatObj){
	            	$('#section').append('<option value ="'+ subcatObj.id +'">'+subcatObj.name+'</option>');
	            });
	        });
    	});	
	</script>
@stop