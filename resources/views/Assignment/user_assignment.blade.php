@extends('layouts.layout')

@section('title', 'List Assignment')

@section('content')

@if (session()->has('flash_message'))
<p>{{ session()->get('flash_message') }}</p>
@endif

@section('body')

@include('flash')
<div class="box box-primary">
    <div class="box-body">


        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Sl.No</th>
                    <th>Submission Date</th>
                    <th>Question</th>
                    <th>Batch</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1 ?>
                @foreach( $allAssignment as $assignment )
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $assignment->sdate }}</td>
                    <td>{!! $assignment->question !!}</td>
                    <td>{{ $assignment->batch }}</td>
               </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
@stop
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