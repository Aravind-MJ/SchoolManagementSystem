

@extends('layouts.layout')

@section('title', 'Hostelers By Batch')

@section('content')

@section('body')

<div class='col-md-offset-1 col-md-9'>
<div class="box box-primary">
    <div class="box-body">
        <?php  $selbatch = isset($selbatch)? $selbatch : null;?>
         <div class="form-group">
       {!! Form::open(array('route' => 'search.hostel', 'class'=>'form navbar-form navbar-right searchform', 'method'=>'get')) !!}
        @if(isset($batch))
        @if(!empty($batch))
          </div>  
        <div class="form-group">
        {!! Form::select('param1', $batch,$selbatch, array('placeholder' => 'Please select batch','class' => 'form-control')) !!}
           </div> 
          <div class="form-group">
        {!! Form::submit('Search', array('class'=>'btn btn-default')) !!}
        {!! Form::close() !!}
        @endif
        @endif
         </div>  
        </div>
</div>
    <div class="box box-primary">
         <div class="box-body">
       @if (count($allStudents) === 0)
        <h4><strong> No Students Found! </strong></h4>
        @elseif (count($allStudents) >= 1)
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                     <th>Sl.No</th>
                    <th>Full name</th>
                    <th>Address</th>
                    <th>Guardian</th>
                    <th>Contact no</th>  
		    <th>edit</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php $i=1 ?>
                @foreach( $allStudents as $student )
               
                <tr>                   
                    <td>{{ $i }}</td>
                    <td>{{ $student->first_name}} {{$student->last_name }} </td>
                    <td> {{ $student ->address}}                     
                                             </td>
                    <td>{{ $student->guardian }}</td>
                    <td>{{ $student->phone }}</td>
					<td><a href='Hostel/{{ $student->user_id }}/edit' class='btn btn-primary btn-block'>change to Day Scholars</a></td>
                   
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    </div>
</div>

</div>
</div>
@section('confirmDelete')
<script>
    $(".delete").on("submit", function () {
        return confirm("Do you want to delete this item?");
    });
</script>
@stop
@section('dataTable')
<script type="text/javascript">
    $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": false,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>
@stop
@endsection