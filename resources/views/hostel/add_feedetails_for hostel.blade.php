
@extends('layouts.layout')

@section('title', 'Paid Students')

@section('content')

@section('body')


<div class='col-md-offset-1 col-md-9'>
<div class="box box-primary">
    <div class="box-body">
       <?php  $division = isset($division)? $division : null;?>
         <div class="form-group">
       {!! Form::open(array('route' => 'search.hostelfee', 'class'=>'form navbar-form navbar-right searchform', 'method'=>'get')) !!}
          </div>  
       <div class="col-md-6">
            <h4>Class</h4>
        {!! Form::select('batch', $batch->class, null, ['class' => 'form-control']) !!}
       </div> 
          <div class="col-md-6">
            <h4>Division</h4>
        {!! Form::select('division',$batch->division, null, ['class' => 'form-control']) !!}
          </div>
        <br>
          <div  class="col-md-6">
        {!! Form::submit('Search', array('class'=>'btn btn-default')) !!}
        {!! Form::close() !!}
         </div>  
        </div>
</div>
    <div class="box box-primary">
         <div class="box-body">
       @if (count($allStudents) === 0)
        <h4><strong> No Students Found! </strong></h4>
        @elseif (count($allStudents) >= 1)
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Sl.No</th>
                    <th>Full name</th>
                    <th>Address</th>
                    <th>Guardian</th>
                    <th>Contact no</th>  
                    <th> Paid Date</th>

                </tr>
            </thead>
            <tbody>
                <?php $i=1 ?>
                @foreach( $allStudents as $student )
               
                <tr>                   
                    <td>{{ $i }}</td>
                    <td>{{ $student->first_name}} {{$student->last_name }} </td>
                    <td> {{ $student ->housename}}                     
                                             </td>
                    <td>{{ $student->guardian }}</td>
                    <td>{{ $student->phone }}</td>
                     <td>{{ $student->created_at}}</td>
		
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    </div>
</div>

</div>
</div>
@section('confirmDelete')
<script>
    $(".delete").on("submit", function () {
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
            "bFilter": false,
            "bSort": false,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>
@stop
@endsection
@section('validation')
<script>
 $(function () {

	    $("form[name='contact']").validate({

	        rules: {
	            name: {required: true,lettersonly: true},
	            email: {required: true,email: true},
	            phone:{
	    			required: true,
	                number: true,
	                minlength:10,
	                maxlength:10,
	                },
	            message:"required"                    
	    },

			messages: {
	            name: {required: "Please enter your name",lettersonly: "Please enter  letters only"},
	            email:{required: "Please enter email", email: "Please enter valid email!"},
	            phone:{required: "Please enter your phone number.",minlength: "Enter 10 digit phone number",maxlength: "Enter 10 digit phone number"},
	            message:"Please enter message"
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


