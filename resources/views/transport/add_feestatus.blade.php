@extends('layouts.layout')

@section('title', 'Add Fee Status')

@section('body')

{!! Form::open(['route' => 'FeeStatus.store','method'=>'POST']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">
           <div class="form-group col-md-6">
            {!! Form::Label('class', 'Class') !!}
            {!! Form::select('class',(['' => 'Select Class'] + $batch->class),$clasz ,['class' => 'form-control']) !!}
        </div>

             <div class="form-group col-md-6">
            {!! Form::Label('division', 'Division') !!}
            {!! Form::select('division',(['' => 'Select Division'] + $batch->division),$division,['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::Label('student_id', 'Student') !!}
            {!! Form::select('student_id',(['' => 'Select Student'] + $users),  null, ['class' => 'form-control']) !!}
        </div>  

        <div class="form-group">
            {!! Form::Label('month', 'Month') !!}
    <?php        $months = ['January'=>'January','February' => 'February','March' => 'March','April' => 'April',
                     'May' => 'May','June' => 'June','July' => 'July','August' => 'August',
                     'September' => 'September','October' => 'October','November' => 'November',
                     'December' => 'December'];  
                     ?>
            {!! Form::select('month',(['' => 'Select Month'] + $months), null, ['class' => 'form-control'] ) !!}
        </div> 

        <div class="form-group">
            {!! Form::Label('year', 'Year') !!}
    <?php        $dates = [date("Y") => date("Y"), date("Y") - 1 => date("Y") - 1, date("Y") - 2 => date("Y") - 2, date("Y") - 3 => date("Y") - 3, date("Y") - 4 => date("Y") - 4] ?>
            {!!  Form::select('year',(['' => 'Select Year'] + $dates), null,['class' => 'form-control']) !!}
        </div> 

        <!--<div class="form-group">
            {!! Form::Label('fee_status', 'Fee Status') !!}
            <?php
            $status = ['01' => 'Paid','02' => 'Not Paid']  ?>
            {!! Form::select('fee_status',(['' => 'Select Status'] + $status),null,['class' => 'form-control']) !!}
        </div>-->

        <div class="form-group">
            {!! Form::Label('fee_status', 'Fee Status') !!}&nbsp;&nbsp;
            {!! Form::hidden('fee_status',0,false) !!} 
            {!! Form::checkbox('fee_status',1,true) !!} 
        
        <br>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>
        {!! Form::close() !!}
    </div>

</div>

@endsection
@section('pagescript')
<script type="text/javascript">

$('#class').change(function(){  
        var clasz = $('#class').val();
        var division=$('#division').val();
        if(clasz!= null ){
            window.location.href='{{url("FeeStatus/create")}}/?class='+clasz+'&division='+division;
        }
    });
    $('#division').change(function(){  
        var clasz = $('#class').val();
        var division=$('#division').val();
        if(clasz!= null ){
            window.location.href='{{url("FeeStatus/create")}}/?class='+clasz+'&division='+division;
        }
    });
</script>
@endsection
