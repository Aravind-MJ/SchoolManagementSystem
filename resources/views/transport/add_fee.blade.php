@extends('layouts.layout')

@section('title', 'Add Bus Fee')

@section('body')

{!! Form::open(['route' => 'BusFee.store','method'=>'POST']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">
        <div class="form-group">
            {!! Form::Label('param1', 'Batch') !!}
            {!! Form::select('param1',(['0' => 'Select batch'] + $batch),$batch_id,['class' => 'form-control']) !!}
        </div> 
        <div class="form-group">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>SL.No</th>
                   
                    <th>Student</th>
                    <th>Bus</th>
                    <th>Fee</th>
                    
                    <th>Clear</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=1 ?>
            
                @foreach( $users as $user )
                
                <tr>
                    <td>{{ $i }}</td>
                  
                    <td>{{ $user->first_name}} {{ $user->last_name}}</td>
                    <td>{!! Form::select('bus_id', (['0' => 'Select bus'] + $buses), null, ['class' => 'form-control']) !!}</td>
                       <td>{!! Form::text('fee', null, ['class' => 'form-control']) !!}</td>              
                    <td class=center>
                        {!! Form::open(['route' => ['BusFee.destroy', $user->id], 'method' => 'DELETE', 'class' => 'delete']) !!}                        
                        <button type="submit" class="btn btn-danger">Clear</button>
                        
                        {!! Form::close() !!}
                    </td>
                    </tr>
                    <?php $i++ ?>
                    @endforeach

                    </tbody>
            </table>
        {!! Form::close() !!}
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>
        
    </div>

</div>
@endsection
@section('pagescript')
<script type="text/javascript">
    $('#param1').change(function(){  
        var batch_id = $('#param1').val();
        window.location.href='{{url("BusFee/create")}}/?param1='+batch_id;
    });
</script>
@endsection
@section('confirmDelete')
<script>
    $(".delete").on("submit", function(){
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
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>
@stop
@endsection