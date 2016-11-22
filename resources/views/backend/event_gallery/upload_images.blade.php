@extends('backend.layouts.layout')
@section('title','Gallery')
@section('small_title','Upload')
@section('event','active')
@section('body')
<style>
    .Enable{
        box-shadow: 0px 0px 10px #019b06;
    }
    .Disable{
        box-shadow: 0px 0px 5px #bf0f00;
    }
</style>
<div class="box box-success">
	<div class="box-body">			
			@if(isset($eventid))
            <div class="col-md-12">                
				<form action="{{route('image.store')}}" enctype="multipart/form-data" class="dropzone" id="book-image" method="post">
					{{csrf_field()}}
					<input type="hidden" value="{{$eventid}}" name="eventid">
				<div>
                    <h3>Upload Images</h3>
                </div>
				</form>
            </div>
            <div class="col-md-2 col-md-offset-5" style="margin-top: 10px;">
                <button class="btn btn-primary btn-block btn-lg" onclick="window.location.href='{{url('event')}}'">Finish</button>
            </div>
			@else
			Event Id not Found
			@endif
	</div>
</div>
                <div class="row">
                @foreach($images as $col)
                    <div class="image col-lg-3 col-md-3 col-sm-6" style="margin-bottom: 20px;">
                        <img src="{{url('images/'.$col->name)}}" class="highlight_{{$col->id}} <?php if($col->deleted_at==null){echo 'Enable';}else{echo 'Disable';} ?>"/>

                        <div class="overlay text-center"><br>

                            <button class="btn-lg btn toggle_button_{{$col->id}} <?php if($col->deleted_at==null){echo 'btn-warning';}else{echo 'btn-lg btn-success';} ?>" onclick="toggle({{$col->id}})">
                            <?php if($col->deleted_at==null){echo 'Disable';}else{echo 'Enable';} ?>
                            </button><br>
                            <form id="capt" action="{{url('caption/'.$col->id)}}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" value="{{$eventid}}" name="event_id">
                                <input type="text" class="form-control" value="{{$col->caption}}" name="caption"> <br>
                                <input type="submit" value="Update Caption" class="btn-lg btn-primary">
                            </form>
                        </div>
                    </div>
				@endforeach
                    </div>
@endsection
@section('page_scripts')
<script>
    function toggle(id){
        var stat = $('.toggle_button_'+id).text();
            $.post('{{url('toggle')}}/'+id,
            {
                status:stat
            },
            function(response){
                if(response=='Enable'||response=='Disable'){
                    $('.toggle_button_'+id).text(response);
                    $('.toggle_button_'+id).toggleClass('btn-warning btn-success');
                    $('.highlight_'+id).toggleClass('Enable Disable');
                }else{
                    alert('Failed to Update database!');
                }
            });
    }
</script>
@endsection

