@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Task
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">

                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Task</span>
                        <div class="float-end">
                            <a class="btn btn-primary btn-sm" href="{{ route('tasks.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('tasks.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('task.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
