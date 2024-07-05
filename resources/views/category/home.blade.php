@extends('components.layouts.admin.app')

@section('title', 'Todo Categories')

@section('content')
    <h1>Todo Categories</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('category.create') }}" class="btn btn-primary">Create Category</a>
    <table class="table mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->category }}</td>
                <td>
                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline;">
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
