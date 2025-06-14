@extends('layouts.app')

@section('template_title')
    {{ $task->name ?? __('Show') . " " . __('Task') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"
                         style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Task</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('tasks.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Title:</strong>
                            {{ $task->title }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Description:</strong>
                            {{ $task->description }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Expiration Date:</strong>
                            {{ $task->expiration_date }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Completed:</strong>
                            @if($task->completed)
                                Yes
                            @else
                                No
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
