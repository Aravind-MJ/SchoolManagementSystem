@extends('layouts.layout')

@section('title', 'Add Activity')

@section('body')

{!! Form::open(['route' => 'Activity.store', 'method'=>'post','enctype' => 'multipart/form-data', 'name' => 'activity']) !!}
<!--{!! Form::open() !!}-->
<div class="box box-primary">
    <div class="box-body">

        <div class="form-group">
            {!! Form::Label('activity_type', 'Activity Type') !!}
            {!! Form::text('activity_type', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
        </div>

        {!! Form::close() !!}
    </div>

</div>
@endsection
@section('validation')
<script>
    
    $(function () {

        $("form[name='activity']").validate({
            errorElement: 'div',
            rules: {
                activity_type: {required: true,lettersonly: true}
                },
             messages: {
                activity_type: {required: "Please enter Activity Type",lettersonly: "Please enter  letters only"}
                 },
            submitHandler: function (form) {
                form.submit();

            }
        });
    });
    
    jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);},    "Letters only please"); 
</script>
@endsection
