@extends('admin.layouts.main')

@section('search')
    <x-admin.search url="{{ route('admin.user.search') }}" />
@endsection

@section('content')
    <x-admin.title-content title="Users"/>
    <x-admin.elements.buttons.create-button
        :route="route('admin.user.create')"
    />
    <div>
        <table class="table table-hover table-dark">
            <thead class="bg-gradient-dark">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Role</th>
                <th scope="col">Email</th>
                <th scope="col" colspan="3" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th  scope="row"  >{{ $user->id }}</th>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role->getLabel() }}</td>

                    <td>{{ $user->email }}</td>

                    <td class="col-1">
                        <x-admin.elements.buttons.show-button class="text-center"
                                                              :route="route('admin.user.show', compact('user'))"
                        />
                    </td>
                    <td class="col-1">
                        <x-admin.elements.buttons.update-button class="text-center"
                                                                :route="route('admin.user.edit', compact('user'))"
                        />
                    </td>
                    <td class="col-1">
                        <x-admin.elements.buttons.delete-button class="text-center"
                                                                :route="route('admin.user.destroy', compact('user'))"
                        />
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
@endsection



