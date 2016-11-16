@extends('layouts.layout')

@section('title', 'Add Book')

@section('content')

@section('body')

{!! Form::open(['action' => 'LibraryController@store','method'=>'POST']) !!}

<div class="box box-primary">
    <div class="box-body">
        <div class="col-md-12">
            <div class="form-group col-md-6">
                {!! Form::label('bookno', 'Book No') !!}
                {!! Form::text('bookno', null, ['class'=>'form-control', 'placeholder'=>'Book No']) !!}
                {!! errors_for('bookno', $errors) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('title', 'Title') !!}
                {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Enter Title']) !!}
                {!! errors_for('title', $errors) !!}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group col-md-6">
                {!! Form::label('author', 'Author name') !!}
                {!! Form::text('author', null,  ['class'=>'form-control', 'placeholder'=>'Author Name']) !!}
                {!! errors_for('author', $errors) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('edition', 'Edition') !!}
                {!! Form::text('edition', null, ['class'=>'form-control', 'placeholder'=>'Enter Edition']) !!}
                {!! errors_for('edition', $errors) !!}
            </div>            
        </div>

        <div class="col-md-12">
            <div class="form-group col-md-6">
                {!! Form::label('subject', 'Subject') !!}
                {!! Form::text('subject', null,  ['class'=>'form-control', 'placeholder'=>'Subject']) !!}
                {!! errors_for('subject', $errors) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('publisher', 'Publisher') !!}
                {!! Form::text('publisher', null,  ['class'=>'form-control', 'placeholder'=>'Publisher']) !!}
                {!! errors_for('publisher', $errors) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group col-md-6">
                {!! Form::label('quantity', 'Quantity') !!}
                {!! Form::text('quantity', null,  ['class'=>'form-control', 'placeholder'=>'Quantity']) !!}
                {!! errors_for('quantity', $errors) !!}
            </div>

            <div class="form-group col-md-6">
                {!! Form::label('bookcost', 'Book Cost') !!}
                {!! Form::text('bookcost', null,  ['class'=>'form-control', 'placeholder'=>'Book Cost']) !!}
                {!! errors_for('bookcost', $errors) !!}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group col-md-6">
                {!! Form::label('language', 'Language') !!}
                {!! Form::text('language', null,  ['class'=>'form-control', 'placeholder'=>'Language']) !!}
                {!! errors_for('language', $errors) !!}
            </div>
            <br>
            <div class="form-group col-md-6">
                {!! Form::submit( 'Submit', ['class'=>'btn btn-primary']) !!} 
            </div>
        </div>
    </div>
</div>


@stop

@endsection

