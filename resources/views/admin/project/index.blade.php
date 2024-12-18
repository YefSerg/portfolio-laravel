@extends('admin.layouts.main')

@section('search')
    <x-admin.search url="{{ route('admin.project.search') }}" />
@endsection

@section('content')
    <x-admin.title-content title="Projects"/>
    <x-admin.elements.buttons.create-button
        :route="route('admin.project.create')"
    />
    <div>
        <table class="table table-hover table-dark">
            <thead class="bg-gradient-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Category</th>
                <th scope="col" colspan="3" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr>
                    <th  scope="row">{{ $project->id }}</th>

                    <td>{{ $project->title }}</td>
                    <td>{!! $project->short_description !!}</td>
                    <td>{{ $project->category->title }}</td>

                    <td class="col-1">
                        <x-admin.elements.buttons.show-button class="text-center"
                                                              :route="route('admin.project.show', compact('project'))"
                        />
                    </td>
                    <td class="col-1">
                        <x-admin.elements.buttons.update-button class="text-center"
                                                                :route="route('admin.project.edit', compact('project'))"
                        />
                    </td>
                    <td class="col-1">
                        <x-admin.elements.buttons.delete-button class="text-center"
                                                                :route="route('admin.project.destroy', compact('project'))"
                        />
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $projects->links() }}

@endsection



