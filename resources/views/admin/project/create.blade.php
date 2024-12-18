@extends('admin.layouts.main')

@section('content')
    <!--suppress CssUnusedSymbol -->
    <x-admin.title-content title="Create project"/>
    <form method="POST" action="{{ route('admin.project.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body row">
            <div class="col-lg-4 col-md-6">
                <div class="form-group">
                    <label for="project__title">Title</label>
                    <input type="text"
                           class="form-control"
                           id="project__title"
                           placeholder="Title"
                           name="title"
                           value="{{ old('title') }}"
                    >
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="form-group">
                    <label for="exampleInputFile">Image input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="image" type="file" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control select2 project__category-select2" style="width: 100%;">
                        <option></option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    @if($category->id === (integer) old('category_id')) selected="selected" @endif>
                                        {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-danger ml-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            Description
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <textarea name="description" id="summernote">{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

        </div>

        <div class="card-footer col-lg-4 col-md-6">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection



