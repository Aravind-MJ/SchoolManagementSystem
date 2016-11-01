@extends('layouts.layout')

@section('title', 'List Bus Fee')

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
                    <th>Bus</th>
                    <th>Fee</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1 ?>
                @foreach( $busfee as $busfee )
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $busfee->batch }}</td>
                    <td>{{ $busfee->first_name }} {{ $busfee->last_name }}</td>
                    <td>{{ $busfee->bus_no }}</td>
                    <td>{{ $busfee->fee }}</td>
                    
                    <td class=center>                       
                        <a href="{{route('BusFee.edit',$busfee->id)}}" class='btn btn-primary'>Edit</a>
                    </td>                   
                    <td class=center>
                        {!! Form::open(['route' => ['BusFee.destroy', $busfee->id], 'method' => 'DELETE', 'class' => 'delete']) !!}                        
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
@stop
@endsection