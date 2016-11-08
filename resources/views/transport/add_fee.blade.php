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

        <div class="box-body">


        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>SL.No</th>
                    <th>Student</th>
                    <th>Bus</th>
                    <th>Fee</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1 ?>
                @foreach($users as $each_users)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $each_users->first_name }} {{ $each_users->last_name }}</td>
                    <td>{{ $each_users->bus_no }}</td>
                    <td>{{ $each_users->fee }}</td>                   
                </tr>
                <?php $i++ ?>
                @endforeach 
            </tbody>

        </table>
    </div>
        {!! Form::close() !!}
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
