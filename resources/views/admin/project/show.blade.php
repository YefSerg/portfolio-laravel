@php
    $mapNamesColumnsDatabaseAndTitlesColumnsTable = [
        'id' => 'Id',
        'title' => 'Title',
        'image' => [
            'title' => 'Image',
            'image' => true,

        ],
        'description' => [
            'title' => 'Description',
            'html' => true,
            ],
        'category' => [
            'title' => 'Category',
            'property' => 'title'
            ]
    ];
@endphp

@extends('admin.layouts.main')

@section('content')
    <x-admin.title-content title="Show project">
        <x-admin.elements.buttons.update-button
            :route="route('admin.project.edit', ['project' => $project])"
            class="d-inline-block ml-2 h5"
        />
        <x-admin.elements.buttons.delete-button
            :route="route('admin.project.destroy', ['project' => $project])"
            class="d-inline-block ml-2 h5"
        />
    </x-admin.title-content>


    <table class="table table-hover table-dark">
        <thead class="bg-gradient-dark">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Image</th>
            <th scope="col">Description</th>
            <th scope="col">Category</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <th  scope="row">{{ $project->id }}</th>

                <td>{{ $project->title }}</td>
                <td>
                    <div class="preview_image mb-2"
                         style='
                                background-image: url("{{ asset('storage/images/' . $project->image) }}");
                                height: 150px;
                                width: 200px;
                                '
                    >
                    </div>
                </td>
                <td>{!! $project->description !!}</td>
                <td>{{ $project->category->title }}</td>
            </tr>
        </tbody>
    </table>
@endsection



