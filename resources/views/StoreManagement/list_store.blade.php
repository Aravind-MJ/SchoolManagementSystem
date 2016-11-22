@extends('layouts.layout')

@section('title', 'List Item Details')

@section('body')
<div class='col-md-offset-1 col-md-10'>
<div class="box box-primary">
    <div class="box-body">
    <div class="box-body" style="overflow-y: scroll">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 30%">Sl.No</th>
                    <th style="width: 30%">Store Type</th>
                    <th style="width: 30%">Brand</th>
                    <th style="width: 30%">Cost</th>
                    <th style="width: 30%">Detail</th>
                    <th style="width: 30%">Stock</th>
                    <th style="width: 30%">Limit</th>
                    <!--<th>Photo</th>-->
                    <th style="width: 5%">Edit</th>
                    <th style="width: 5%">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1?>
                @foreach( $AllStore as $Store)
                <tr>
                    <td>{{ $i }}</td>
                    
                     <td>{{$Store->store_type}}</td>
                     <td>{{$Store->item_brand}}</td>
                     <td>{{$Store->item_cost}}</td>
                     <td>{{$Store->item_detail}}</td>
                     <td>{{$Store->item_stock}}</td>
                     <td>{{$Store->item_limit}}</td>
                    <td class=center>
                        <a class="btn btn-primary btn-block" href="{{url('StoreManagement/'.$Store->id).'/edit'}}">Edit</a>
                    </td>
                    
                    <td class=center>
                        {!! Form::open(['route' => ['StoreManagement.destroy', $Store->id], 'method' => 'POST', 'onsubmit' => 'return ConfirmDelete()'])  !!}
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="id" value="{{$Store->id}}">
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