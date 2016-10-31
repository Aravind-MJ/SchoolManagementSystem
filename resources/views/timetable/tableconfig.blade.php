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

      <div class="box box-success">
	      <div class="box-body">
			  <fieldset>
				<table id="example2" border='1' class="table table-bordered table-hover">
				<tr>
					<td>No of working days in a week </td>
	          <td>  <select name="week">         
		        <option>-Select-</option>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
            <option>7</option></select></td>
          </tr>
                <tr>
                  <td>No of working hours in a day</td> 
                       <td><select name="day">
                         <option>-Select-</option>
                         <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                          <option>6</option>
                          <option>7</option>
                         <option>8</option> </select></td>
                    </tr>
                      <tr>
                       <td> <center><input type="submit" value="Save"/ required > </center></td>
                      </tr> 
                    </table>
                 </fieldset>

{!! Form::close() !!}

@stop

@endsection