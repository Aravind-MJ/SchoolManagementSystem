@extends('layouts.layout')

@section('title', 'List Activity')

@section('body')

<div class='col-md-offset-1 col-md-10'>
<div class="box box-primary">
    <div class="box-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 30%">Sl.No</th>
                    <th style="width: 30%">Student</th>
                    <th style="width: 30%">class</th>
                     <th style="width: 30%">division</th>
                    <th style="width: 30%">Activity Type</th>
                    <th style="width: 30%">Remark</th>
                    <!--<th>Photo</th>-->
                    <th style="width: 5%">Edit</th>
                    <th style="width: 5%">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1?>
                @foreach( $allActivityDetails as $ActivityDetails)
                <tr>
                    <td>{{ $i }}</td> 
                    <td>{{ $ActivityDetails->first_name}}</td>
                    <td>{{ $ActivityDetails->class}}</td>
                    <td>{{ $ActivityDetails->division}}</td>
                    <td>{{ $ActivityDetails->activity_type}}</td> 
                    <td>{{ $ActivityDetails->remark }}</td> 
                    
                    <td class=center>
                        <a class="btn btn-primary btn-block" href="{{url('ActivityDetails/'.$ActivityDetails->id).'/edit'}}">Edit</a>
                    </td>
                    
                    <td class=center>
                        {!! Form::open(['route' => ['ActivityDetails.destroy', $ActivityDetails->id], 'method' => 'POST', 'onsubmit' => 'return ConfirmDelete()'])  !!}
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="id" value="{{$ActivityDetails->id}}">
                        <button type="submit" class="btn btn-danger btn-block">Delete</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
                 <?php $i++ ?>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
    </div>
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
@endsection