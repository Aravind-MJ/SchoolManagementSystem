@extends('layouts.layout')

@section('title', 'Fee Status')

@section('content')

@if (session()->has('flash_message'))
<p>{{ session()->get('flash_message') }}</p>
@endif

@section('body')


<div class="box box-primary">
    <div class="box-body">


        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>SL.No</th>
                    <th>Batch</th>
                    <th>Student</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1 ?>
                @foreach( $feestatus as $each_feestatus )
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $each_feestatus->class }} {{ $each_feestatus->division }}</td>
                    <td>{{ $each_feestatus->first_name }} {{ $each_feestatus->last_name }}</td>
                   
                    <td>{{ $each_feestatus->month }}</td>
                    <td>{{ $each_feestatus->year }}</td>

                    @if($each_feestatus->status==1)
                    <td><b><font color="green">Paid</font></b></td>
                    

                    @else
                        <td><b><font color="red">Not paid</font></b></td>
                    @endif
                    <td class=center>                       
                    <a href="{{route('FeeStatus.edit',$each_feestatus->id)}}" class='btn btn-primary'>Edit</a>
                    </td>                   
                    <td class=center>
                        {!! Form::open(['route' => ['FeeStatus.destroy', $each_feestatus->id], 'method' => 'DELETE', 'class' => 'delete']) !!}                        
                        <button type="submit" class="btn btn-danger">Delete</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
                <?php $i++ ?>
                @endforeach 
            </tbody>

        </table>
    </div>

</div>
@stop
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