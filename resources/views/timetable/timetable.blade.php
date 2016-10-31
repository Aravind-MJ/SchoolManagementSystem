@extends('layouts.layout')

@section('title', 'Time Table')

@section('content')

@section('body')

@include('flash')



{!! Form::open(array('url' => 'foo/bar')) !!}


<div class="box box-success">
	<div class="box-body">
			<table id="example2" border='1' class="table table-bordered table-hover">
				<thead>
				<tr>
					<th>
				{!! HTML::link('/', 'Table Generation')!!}

				</th>
                    <th>
                {!! HTML::link('/', 'Table Configuration')!!}

                    </th>
</tr>
</table>

		
	</div>
</div>

{!! Form::close() !!}

{!! Form::open(array('url' => 'Table Generation')) !!}

@stop

@endsection