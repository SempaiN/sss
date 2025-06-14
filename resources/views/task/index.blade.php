@extends('layouts.app')

@section('template_title')
    Tasks
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tasks') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm float-right"
                                   data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                                @php
                                    $nextOrder = (request('order') === 'desc') ? 'asc' : 'desc';
                                @endphp

                                <a href="{{ route('tasks.index', ['sort' => 'expiration_date', 'order' => $nextOrder]) }}"
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
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Expiration Date</th>
                                    <th>Completed</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->description }}</td>
                                        <td>{{ $task->expiration_date }}</td>

                                        <td>
                                            <form action="{{ route('tasks.toggle', $task->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="checkbox"
                                                       onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                            </form>
                                        </td>

                                        <td>
                                            <a class="btn btn-sm btn-primary"
                                               href="{{ route('tasks.show', $task->id) }}">
                                                <i class="fa fa-fw fa-eye"></i> {{ __('Show') }}
                                            </a>
                                            <a class="btn btn-sm btn-success"
                                               href="{{ route('tasks.edit', $task->id) }}">
                                                <i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                                  style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to eliminate this task?')">
                                                    <i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $tasks->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection

