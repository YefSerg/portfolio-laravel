@extends('admin.layouts.main')

@section('content')
    <x-admin.title-content title="Edit category"/>
    <form method="POST" action="{{ route('admin.category.update', ['category' => $category]) }}">
        @method('PATCH')
        @csrf
        <div class="card-body row">
            <div class="form-group col-lg-4 col-md-6">
                <label for="category__title">Title</label>
                <input
                    type="text"
                    class="form-control"
                    id="category__title"
                    placeholder="Title"
                    name="title"
                    value="{{ $category->title }}"
                >
                @error('title')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="card-footer col-lg-4 col-md-6">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection



