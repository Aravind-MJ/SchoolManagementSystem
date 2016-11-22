@extends('layouts.layout')

@section('title', 'Register Mark')

@section('body')

<style>
    .app-section .btn-app strong{
        font-size: 17px;
        text-align: center;
    }
</style>
<div class="box box-warning">
            <div class="box-header">
                <div class="box-title">Select Batch and Exam</div>
            </div>
            <div class="box-body">
                {!! Form::open() !!}
            <div class="form-group col-lg-5 col-md-5">
            {!! Form::Label('class', 'class') !!}
            {!! Form::select('class', $batch->class, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-lg-5 col-md-5">
            {!! Form::Label('division', 'division') !!}
            {!! Form::select('division', $batch->division, null, ['class' => 'form-control']) !!}
            </div>
                <div class="form-group col-lg-10 col-md-10">
                <label for="batch">Select Exam</label>
                {!! Form::select('exam-id',$exam,'0',array('class'=>'form-control exam-id')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
<div class="box box-primary">
    <div class="box-header">
        <div class="box-title"><strong>Students</strong></div>
    </div>
    <div class="box-body">
        <div class="app-section">
            <h4>Select a Batch to view Students</h4>
        </div>
    </div>
</div>
@endsection

@section('pagescript')
    <script>
    $(document).ready(function(){
        function process(){
            var clasz = $('#class').val();
            var division = $('#division').val();
            if(clasz != '' && division != ''){
                var examId = $('.exam-id').val();
                $('.loading-screen').show();
                $.post('{{url('fetchStudents')}}',{
                    clasz:clasz,
                    division:division,
                    exam_id:examId
                },
                function(response){
                    $('.app-section').html(response);
                    var val = $('.exam-id').val();
                    $('.exam_id').attr('value',val);
                    $('.loading-screen').hide();
                });
            }
        }
        $('.select-batch').val(null);

        $('#class').change(function(){
            process();
        });
        $('#division').change(function(){
            process();
        });
        $('.exam-id').change(function(){
            process();
        });

        $('.exam-id').change(function(){
            var val = $('.exam-id').val();
            $('.exam_id').attr('value',val);
        });
    });
    </script>
@stop