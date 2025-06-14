<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2">
            <label for="task_id" class="form-label">{{ __('Select a Task') }}</label>
            <select name="task_id" id="task_id" class="form-control @error('task_id') is-invalid @enderror">
                <option value="">-- Select a task --</option>
                @foreach ($userTasks as $task)
                    <option value="{{ $task->id }}"
                        {{ old('task_id', $sharedTask?->task_id) == $task->id ? 'selected' : '' }}>
                        {{ $task->title }} (vence {{ $task->expiration_date }})
                    </option>
                @endforeach
            </select>
            {!! $errors->first('task_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2">
            <label for="user_id" class="form-label">{{ __('Share with:') }}</label>
            <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                <option value="">-- Select the user --</option>
                @foreach ($users as $user)
                    @if ($user->id !== auth()->id())
                        <option value="{{ $user->id }}"
                            {{ old('user_id', $sharedTask?->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endif
                @endforeach
            </select>
            {!! $errors->first('user_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>

    <div class="col-md-12 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Share Task') }}</button>
    </div>
</div>
