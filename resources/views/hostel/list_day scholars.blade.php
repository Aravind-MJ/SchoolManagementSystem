

@extends('layouts.layout')

@section('title', 'Dayscholars By Class')

@section('content')

@section('body')

<div class='col-md-offset-1 col-md-9'>
<div class="box box-primary">
    <div class="box-body">
       <?php  $division = isset($division)? $division : null;?>
         <div class="form-group">
       {!! Form::open(array('route' => 'search.dayscholars', 'class'=>'form navbar-form navbar-right searchform', 'method'=>'get')) !!}
          </div>  
       <div class="col-md-6">
            <h4>Class</h4>
        {!! Form::select('batch', $batch->class, null, ['class' => 'form-control']) !!}
           </div> 
          <div class="col-md-6">
            <h4>Division</h4>
        {!! Form::select('division',$batch->division, null, ['class' => 'form-control']) !!}
          </div>
        <br>
          <div  class="col-md-6">
        {!! Form::submit('Search', array('class'=>'btn btn-default')) !!}
        {!! Form::close() !!}
         </div>  
        </div>
</div>
    <div class="box box-primary">
       <div class="box-body" style="overflow-y: scroll">

       @if (count($alStudents) === 0)
        <h4><strong> No Students Found! </strong></h4>
        @elseif (count($alStudents) >= 1)
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
                 @foreach( $alStudents as $student )
                <tr>                   
                    <td>{{ $i }}</td>
                    <td>{{ $student->first_name}} {{$student->last_name }}</td>
                    <td>{{ $student->housename}}</td>                                                  
                    <td>{{ $student->guardian }}</td>
                    <td>{{ $student->phone }}</td>
					
                    <td class=center>
                        <a class="btn btn-primary btn-block" href="{{url('Hostel/'.$student->user_id)}}">Change to hostel</a>
                    </td>

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
