@extends('layouts.layout')

@section('title', 'Time Table')

@section('body')

@include('tablelink')
    <div class="col-md-6">
        {!! Form::open(['route' => ['Timetable.store'], 'method' => 'POST']) !!}
        <div class="box box-success">
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('batch', 'Batch') !!}
                    {!! Form::select('batch',$batch,null,['class' => 'form-control', 'placeholder'=>''])!!}
                    {!! errors_for('batch', $errors) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('faculty', 'Faculty') !!}
                    {!! Form::select('faculty',$faculty,null,['class' => 'form-control', 'placeholder'=>''])!!}
                    {!! errors_for('faculty', $errors) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('subject', 'Subject') !!}
                    {!! Form::select('subject',$subject,null,['class' => 'form-control', 'placeholder'=>''])!!}
                    {!! errors_for('subject', $errors) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('no_of_periods', 'No of periods') !!}
                    {!! Form::select('no_of_periods',[null=>'Select no of periods',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5',6=>'6',7=>'7'],null,['class' => 'form-control', 'placeholder'=>''])!!}
                    {!! errors_for('no_of_periods', $errors) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('sticky', 'Sticky?') !!}
                    {!! Form::checkbox('sticky','YES',false)!!}
                    {!! errors_for('sticky', $errors) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Add Option',['class'=>'btn btn-primary'])!!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="col-md-6">
        <div class="box box-success">
        <div class="box-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <td>Class</td>
                    <td>Subjects</td>
                    <td>No. of periods</td>
                    <td>Sticky?</td>
                    <td>Remove</td>
                </tr>
            </thead>
            <tbody>
            @foreach($options as $option)
                <tr>
                    <td>{{$option->batch}}</td>
                    <td>{{$option->subject_name}}<br>({{$option->first_name}} {{$option->last_name}})</td>
                    <td>{{$option->no_of_periods}}</td>
                    <td>{{$option->sticky}}</td>
                    <td>
                        {!! Form::open(['route' => ['Timetable.destroy', $option->id], 'method' => 'DELETE']) !!}
                            <button type="submit" class="btn btn-danger">   Remove </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
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
    $(document).ready(function(){
      $('input').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
      });
    });
</script>
@endsection