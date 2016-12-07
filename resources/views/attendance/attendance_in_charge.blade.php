@extends('layouts.layout')

@section('title', 'Mark Attendance')

@section('body')

<style>
    .app-section .btn-app strong{
        font-size: 17px;
        text-align: center;
    }
</style>
        <div class="box box-primary">
        <div class="box-body">
        <div class="box-header">
            <div class="box-title"><strong><i class="fa fa-clock-o"></i> &nbsp; Batches </strong></div>
        </div>
        <div class="app-section">
            <?php
                foreach ($batch as $each_batch) {
                        if($each_batch['status']=='unmarked'){
                ?>
                    <a class="btn btn-app box_batch" href="{{url('attendance/mark/'.$each_batch['enc_id'])}}">
                        <i class="fa fa-users"></i>
                        <strong><?= $each_batch['class'] ?> <?= $each_batch['division'] ?></strong>
                    </a>
            <?php
                } else {
                ?>
                    <a class="btn btn-app box_batch">
                        <i class="fa fa-check"></i>
                        <strong><?= $each_batch['class'] ?> <?= $each_batch['division'] ?></strong>
                    </a>
                <?
                        }
                }
                ?>
                </div>
                </div>
        </div>
@endsection

@section('pagescript')

@stop