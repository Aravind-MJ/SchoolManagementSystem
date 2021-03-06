@extends('layouts.layout')

@section('title', 'SMS History')

@section('content')

@section('body')
<div class="box box-primary">
    <div class="box-body">


        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>SMS Type</th>
                    <th>Send By</th>
                    <th>Recipients</th>
                    <th>Message</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
               
                @foreach( $data as $each )
                <tr>
                    <td>{{ $each->type }}</td>
                    <td>{{ $each->name }}</td>
                    <td>{{ $each->numbers }}</td>
                    <td>{{ $each->message }}</td>
                    <td>{{ $each->time }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
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