@extends('layout')

@section('modal-delete')
	<div id="myModalDelete" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
        			<h4 class="modal-title">Eliminar solicitud</h4>
				</div>
				<div class="modal-body">
					<p>¿Está seguro que desea eliminar esta solicitud?</p>
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
        			<h4 class="modal-title">Editar usuario</h4>
				</div>
				
				<form method="POST" action="" id="edit">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
						<div class="modal-body">
							<div class=" form-group checkbox">
			  				    <label class="control-label"><input type="checkbox" name="created">Creado</label>
						    </div>
						    <div class=" form-group checkbox">
			  				    <label class="control-label"><input type="checkbox" name="sent">Enviado</label>
						    </div>

							<div class="form-group">
					            <label class="control-label">Código:</label>
					            <div class="form-group">
					                <input type="text" class="form-control" name="cod_art" id="cod_art" placeholder="Ingrese el código del artículo creado." autofocus>
					            </div>
					        </div>
					        <div class="form-group">
					            <label class="control-label">Descripción:</label>
					            <div class="form-group">
					                <textarea name="des_art" id="des_art" class="form-control" placeholder="Ingrese la descripción del artículo creado."></textarea>
					            </div>
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

@section('request')
	<div class="col-md-11">
		<table class="table table-striped">
		    <thead>
		      <tr>
		        <th>#</th>
		        <th>Usuario</th>
		        <th>Artículo</th>
		        <th>Uso</th>
		        <th>Genérico</th>
		        <th>UND</th>
		        <th>Explicación</th>
		        <th>Dpto</th>
		        <th>Sección</th>
		        <th>Creado</th>
		        <th>Enviado</th>
		        <th>Código</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($articleRequests as $articleRequest)
		      		<tr>
		      			<td>{{ $articleRequest->id }}</td>
		        		<td data-toggle="tooltip" data-placement="top" title="{{ $articleRequest->user->telephone }}" data-container="body">{{ $articleRequest->user->name }}</td>
		        		<td>{{ $articleRequest->article_name }}</td>
		        		<td>{{ $articleRequest->usage }}</td>
		        		@if ( $articleRequest->generic == 1)
		        			<td style="text-align:center"><input type="checkbox" checked disabled></td>
						@else
							<td style="text-align:center"><input type="checkbox" unchecked disabled></td>
						@endif
		        		<td>{{ $articleRequest->unit }}</td>
		        		<td>{{ $articleRequest->explanation }}</td>
		        		<td class="department" data-toggle="tooltip" data-placement="top" title="{{ $articleRequest->department->name }}" data-container="body">{{ $articleRequest->department->code }}</td>
		        		<td class="section" data-toggle="tooltip" data-placement="top" title="{{ $articleRequest->section->name }}" data-container="body">{{ $articleRequest->section->code }}</td>
		        		@if ( $articleRequest->created == 1)
		        			<td style="text-align:center"><input type="checkbox" checked disabled></td>
						@else
							<td style="text-align:center"><input type="checkbox" unchecked disabled></td>
						@endif
						@if ( $articleRequest->sent == 1)
		        			<td style="text-align:center"><input type="checkbox" checked disabled></td>
						@else
							<td style="text-align:center"><input type="checkbox" unchecked disabled></td>
						@endif
						<td>{{ $articleRequest->cod_art }}</td>
						<td align="right"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit" data-id="{{$articleRequest->id}}"><span class="glyphicon glyphicon-pencil"></span></button></td>
			        	<td><button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete" data-id="{{$articleRequest->id}}"><span class="glyphicon glyphicon-trash"></span></button>
			        	</td>
		     		</tr>
		     	@endforeach	     
		    </tbody>
		 </table>
	</div>
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
		    $('[data-toggle="tooltip"]').tooltip(); 
		});

		$('#myModalDelete').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var request_id = button.data('id')
		  $('form[id="delete"]').attr('action','request/' + request_id)
		});

		$('#myModalEdit').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var request_id = button.data('id')

		  $.get('/request/getArticleRequest/' + request_id, function(response){
  			if (response.created) {
			    $('input[name="created"]').prop('checked', true);
			} else {
			    $('input[name="created"]').prop('checked', false);
			}
			if (response.sent) {
			    $('input[name="sent"]').prop('checked', true);
			} else {
			    $('input[name="sent"]').prop('checked', false);
			}
		  })
		  $('form[id="edit"]').attr('action','request/' + request_id)
		});
	</script>
@stop

