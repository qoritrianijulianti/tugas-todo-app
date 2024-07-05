@extends('components.layouts.admin.app')

@section('title', 'Edit Todo')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('todo.update', $todo->id) }}">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="todo_category_id" class="form-label">Category</label>
            <select class="form-select" name="todo_category_id" id="todo_category_id">
                <option selected>Open this select menu</option>
                @foreach ($todocategories as $value)
                    <option value="{{ $value->id }}" {{ $todo->todo_category_id == $value->id ? 'selected' : '' }}>{{ $value->category }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $todo->title }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $todo->description }}">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="checkbox" id="status" name="status" value="1" {{ $todo->status ? 'checked' : '' }}> Done
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
