@extends('admin.layouts.main')

@section('search')
    <x-admin.search url="{{ route('admin.category.search') }}" />
@endsection

@section('content')
    <x-admin.title-content title="Categories"/>
    <x-admin.elements.buttons.create-button
        :route="route('admin.category.create')"
    />
    <div>
        <table class="table table-hover table-dark">
            <thead class="bg-gradient-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col" colspan="3" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th  scope="row"  >{{ $category->id }}</th>
                    <td>{{ $category->title }}</td>

                    <td class="col-1">
                        <x-admin.elements.buttons.show-button class="text-center"
                                                              :route="route('admin.category.show', compact('category'))"
                        />
                    </td>
                    <td class="col-1">
                        <x-admin.elements.buttons.update-button class="text-center"
                                                                :route="route('admin.category.edit', compact('category'))"
                        />
                    </td>
                    <td class="col-1">
                        <x-admin.elements.buttons.delete-button class="text-center"
                                                                :route="route('admin.category.destroy', compact('category'))"
                        />
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $categories->links() }}
@endsection



