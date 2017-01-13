@extends('layout')

@section('panel')
    @include('dashboard')
@stop

@section('sidebar')
	@include('departments.sidebar')
@stop

@section('content')	
	<table class="table table-striped">
	    <thead>
	      <tr>
	      	<th>Departamento</th>
	        <th>Código</th>
	        <th>Sección</th>
	      </tr>
	    </thead>
	    <tbody>
	    	@foreach($department->sections as $section)
	      		<tr>
	      			<td>{{ $department->name }}</td>
	        		<td>{{ $section->code }}</td>
		        	<td>{{ $section->name }}</td>
	     		</tr>
	     	@endforeach	     
	    </tbody>
	 </table>
@stop