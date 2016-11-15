@extends('layouts.layout')

@section('title', 'List Buses')

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
                    <th>Bus Number</th>
                    <th>Number Plate</th>
                    <th>Driver</th>
                    <th>Cleaner</th>
                    <th>Route</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1 ?>
                @foreach( $allbuses as $buses )
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $buses->bus_no}}</td>
                    <td>{{ $buses->number_plate}}</td>
                    <td>{{ $buses->driver}}</td>
                    <td>{{ $buses->cleaner}}</td>
                    <td>{{ $buses->route}}</td>

                    <td class=center>                       
                        <a href="{{route('transportation.edit',$buses->id)}}" class='btn btn-primary'>Edit</a>
                    </td>                   
                    <td class=center>
                        {!! Form::open(['route' => ['transportation.destroy', $buses->id], 'method' => 'DELETE', 'class' => 'delete']) !!}                        
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