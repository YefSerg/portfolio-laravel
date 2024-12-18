@extends('admin.layouts.main')

@section('content')
    <x-admin.title-content title="Show category">
        <x-admin.elements.buttons.update-button
            :route="route('admin.category.edit', ['category' => $category])"
            class="d-inline-block ml-2 h5"
        />
        <x-admin.elements.buttons.delete-button
            :route="route('admin.category.destroy', ['category' => $category])"
            class="d-inline-block ml-2 h5"
        />
    </x-admin.title-content>


    <table class="table table-hover table-dark">
        <thead class="bg-gradient-dark">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <th  scope="row"  >{{ $category->id }}</th>
                <td>{{ $category->title }}</td>
            </tr>
        </tbody>
    </table>
@endsection



