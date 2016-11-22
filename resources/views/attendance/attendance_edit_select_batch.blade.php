@extends('layouts.layout')

@section('title', 'Edit Attendance by Batch')

@section('body')

<style>
    .app-section .btn-app strong{
        font-size: 17px;
        text-align: center;
    }
</style>
        <div class="box box-primary">
        <div class="box-header">
            <div class="box-title"><strong><i class="fa fa-clock-o"></i> &nbsp; Batches</strong></div>
        </div>
        <div class="box-body">
        <div class="app-section">
            <?php
                foreach ($batch as $each_batch) {
                ?>
                    <a class="btn btn-app box_batch" href="{{url('edit/attendance/'.$each_batch['enc_id'])}}">
                        <i class="fa fa-folder-open"></i>
                        <strong><?= $each_batch['class'] ?> <?= $each_batch['division'] ?></strong>
                    </a>
            <?php
                }
                ?>
                </div>
                </div>
        </div>
@endsection

@section('pagescript')

@stop