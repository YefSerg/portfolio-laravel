@extends('admin.layouts.main')

@section('content')
    <x-admin.title-content title="Show user">
        <x-admin.elements.buttons.update-button
            :route="route('admin.user.edit', ['user' => $user])"
            class="d-inline-block ml-2 h5"
        />
        <x-admin.elements.buttons.delete-button
            :route="route('admin.user.destroy', ['user' => $user])"
            class="d-inline-block ml-2 h5"
        />
    </x-admin.title-content>


    <table class="table table-hover table-dark">
        <thead class="bg-gradient-dark">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
            <th scope="col">Email</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <th  scope="row"  >{{ $user->id }}</th>

                <td>{{ $user->name }}</td>
                <td>{{ $user->role->getLabel() }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        </tbody>
    </table>
@endsection



