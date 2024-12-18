@extends('admin.layouts.main')

@section('content')
    <x-admin.title-content title="Create user"/>
    <form method="POST" action="{{ route('admin.user.store') }}">
        @csrf
        <div class="card-body row">
            <div class="form-group col-lg-4 col-md-6">
                <label for="user__name">Name</label>
                <input type="text"
                       class="form-control"
                       id="user__name"
                       placeholder="Name"
                       name="name"
                       value="{{ old('name') }}">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                <label class="mt-1" for="user__email">Email</label>
                <input type="email"
                       class="form-control"
                       id="user__email"
                       placeholder="Email"
                       name="email"
                       value="{{ old('email') }}" >
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                <label class="mt-1" for="user__password">Password</label>
                <input type="password"
                       autocomplete="off"
                       class="form-control"
                       id="user__password"
                       placeholder="Password"
                       name="password">
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                <label class="mt-1" for="user__password-confirm">Password confirmation</label>
                <input
                    type="password"
                    autocomplete="off"
                    class="form-control"
                    id="user__password-confirm"
                    placeholder="Password confirmation"
                    name="password_confirmation">
                @error('password_confirmation')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control select2 user__status-select2" style="width: 100%;">
                        @foreach($roles as $role)
                            <option value="{{ $role->value }}"
                                    @if($role->value === (integer) old('role')) selected="selected" @endif>
                                {{ $role->getLabel() }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                    <p class="text-danger ml-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>


        <div class="card-footer col-lg-4 col-md-6">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection



