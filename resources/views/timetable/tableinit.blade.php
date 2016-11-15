@extends('layouts.layout')

@section('title', 'Time Table')

@section('body')
<div class="box box-success">
    <div class="box-body">
        @include('tablelink')<br>
<div class="row">
    <div class="col-md-6">
        {!! Form::open(['route' => ['Timetable.store'], 'method' => 'POST','class' => 'init-form']) !!}
        {!! Form::hidden('_method','POST')!!}
        <div class="box box-success">
            <div class="box-body">
            <div class="alert alert-info" style="display: none;" id="Notice">
                <span class="fa fa-info" style="font-size: 20px"></span>
                <strong style="font-size: 16px; padding: 10px;">You have selected an option to edit. Changes values here itself for Update.</strong>
            </div>
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
                    {!! Form::reset('Reset form',['class'=>'btn btn-primary'])!!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        <div class="box box-success">
            <div class="box-header">
                <div class="box-title">Recently changed options</div>
            </div>
            <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td>Class</td>
                        <td>Subjects</td>
                        <td>No. of periods</td>
                        <td>Sticky?</td>
                        <td>Edit</td>
                        <td>Remove</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latest as $option)
                    <tr>
                        <td>{{$option->batch}}</td>
                        <td>{{$option->subject_name}}<br>({{$option->first_name}} {{$option->last_name}})</td>
                        <td>{{$option->no_of_periods}}</td>
                        <td>{{$option->sticky}}</td>
                        <td><button type="submit" class="btn btn-warning" onclick="editOption('{{json_encode($option)}}')">Edit</button></td>
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
    <div class="col-md-6">
        <div class="box box-success">
        <div class="box-header">
            <div class="box-title">All options Ordered Batch wise</div>
        </div>
        <div class="box-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <td>Class</td>
                    <td>Subjects</td>
                    <td>No. of periods</td>
                    <td>Sticky?</td>
                    <td>Edit</td>
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
                    <td><button type="submit" class="btn btn-warning" onclick="editOption('{{json_encode($option)}}')">Edit</button></td>
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
</div>
    </div>
</div>
@endsection
@section('dataTable')
<script type="text/javascript">
    $(function () {
        $("#example2").dataTable();
        $('#example1').dataTable({
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
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

    function editOption(json){
        var object = JSON.parse(json);
        console.log(object);
        $('.init-form #Notice').show();
        $('.init-form input[name="_method"]').val('PATCH');
        $('.init-form').attr('action','{{url('Timetable')}}/'+object.id);
        $('.init-form #batch').val(object.batch_id);
        $('.init-form #faculty').val(object.faculty_id);
        $('.init-form #subject').val(object.subject_id);
        $('.init-form #no_of_periods').val(object.no_of_periods);
        if(object.sticky=='YES'){
            $('.init-form .icheckbox_flat-green').addClass('checked');
        }else{
            $('.init-form .icheckbox_flat-green').removeClass('checked');
        }
        $('.init-form input[type="submit"]').val('Update Chosen Option');
    }

    $('.init-form input[type="reset"]').click(function(){
        $('.init-form #Notice').hide();
        $('.init-form .icheckbox_flat-green').removeClass('checked');
        $('.init-form').attr('action','{{url('Timetable')}}');
        $('.init-form input[name="_method"]').val('POST');
        $('.init-form input[type="submit"]').val('Add Option');
    });
</script>
@endsection