@extends('components.layouts.admin.app')

@section('title', 'Todo List')

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
    <table class="table">
        <thead>
        <tr>
            <th>Category</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($todos as $todo)
            <tr>
                <td>{{ $todo->category->category }}</td>
                <td>{{ $todo->title }}</td>
                <td>{{ $todo->description }}</td>
                <td>
                    <form action="{{ route('todo.updateStatus', $todo->id) }}" method="POST">
                        @csrf
                        <select class="form-select {{ $todo->status ? 'bg-success' : 'bg-danger' }}" name="status" onchange="this.form.submit()">
                            <option value="0" {{ !$todo->status ? 'selected' : '' }}>Not Done</option>
                            <option value="1" {{ $todo->status ? 'selected' : '' }}>Done</option>
                        </select>
                    </form>
                </td>
                <td>
                    <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('todo.destroy', $todo->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
