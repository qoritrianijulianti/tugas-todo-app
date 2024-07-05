@extends('components.layouts.admin.app')

@section('title', 'Create Category')

@section('content')
    <h1>Create Category</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('category.store') }}">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
