@extends('layouts.layout')

@section('title', 'List Books')

@section('content')

@if (session()->has('flash_message'))
<p>{{ session()->get('flash_message') }}</p>
@endif

@section('body')


<div class="box box-primary">
    <div class="box-body" style="overflow-y: scroll">

        <table id="example2" class="table table-bordered table-hover">            
            <thead>
                <tr>
                    <th>Sl.No</th>
                    <th>Book.No</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Edition</th>
                    <th>Subject</th>
                    <th>Publisher</th>
                    <th>Quantity</th>
                    <th>Book Cost</th>
                    <th>Language</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1 ?>
                @foreach( $allBooks as $book )
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $book->bookno }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->edition }}</td>
                    <td>{{ $book->subject }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->quantity }}</td>
                    <td>{{ $book->bookcost }}</td>
                    <td>{{ $book->language }}</td>
                    <td class=center>
                       
                        <a href='Library/{{ $book->enc_id }}/edit' class='btn btn-primary'>Edit</a>
                    </td>
                    
                    <td class=center>
                        {!! Form::open(['action' => ['LibraryController@destroy', $book->id], 'method' => 'POST', 'class' => 'delete']) !!}
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="id" value="{{$book->id}}">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        {!! Form::close() !!}
                    </td>
                </tr>
                <?php $i++ ?>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
@stop
@section('confirmDelete')
<script>
    $(".delete").on("submit", function(){
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
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });
</script>
@stop
@endsection