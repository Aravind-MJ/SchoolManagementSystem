@extends('layouts.layout')

@section('title', 'List Classdetails')

@section('content')

@section('body')


<div class="box box-primary">
    <div class="box-body">


        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>class</th>
                     <th>Division</th>
                    <th>year</th>
                    <th>In_charge</th>              
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allBatchdetails as $Batchdetails)
                <tr>
                     <td>{{ $Batchdetails->class}}</td>
                     <td>{{ $Batchdetails->division}}</td>
                     <td>{{ $Batchdetails->year}}</td>
                     <td>{{ $Batchdetails->first_name}}</td>
              

                    <td class=center>
                        <a class="btn btn-success" href="{{url('ClassDetails/'.$Batchdetails->enc_id).'/edit'}}">Edit</a>
                    </td>
                    <td class=center>
                        {!! Form::open(['route' => ['ClassDetails.destroy', $Batchdetails->enc_id], 'method' => 'POST','onsubmit' => 'return ConfirmDelete()'])  !!}
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="id" value="{{$Batchdetails->id}}">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        {!! Form::close() !!}
                    </td>
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
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>
@stop
@endsection