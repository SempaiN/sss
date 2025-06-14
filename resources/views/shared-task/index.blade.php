@extends('layouts.app')

@section('template_title')
    Shared Tasks
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Shared Tasks') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('shared-tasks.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                                 @php
                                     $nextOrder = (request('order') === 'desc') ? 'asc' : 'desc';
                                 @endphp

                                 <a href="{{ route('shared-tasks.index', ['sort' => 'expiration_date', 'order' => $nextOrder]) }}"
                                    class="btn btn-secondary btn-sm ml-2">
                                     {{__('Sort by date')}}
                                 </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

									<th >Title</th>
									<th >Description</th>
                                    <th>Expiration date</th>
                                        <th>Author</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($sharedTasks as $task)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->description }}</td>
                                        <td>{{ $task->expiration_date }}</td>
                                        <td>{{ $task->user->name }}</td>
                                        <td>
                                            <input type="checkbox" disabled {{ $task->completed ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $sharedTasks->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
