@extends('layouts.back')

@section('title', 'Edit User')

@section('content')
    <div class="page-user-edit">
        <h1 class="table-title">Edit User: <span class="table-title-name">{{ $user->last_name }}
                {{ $user->first_name }}</span></h1>

        <form action="{{ route('back.user.update', $user->id) }}" method="POST" class="form-valo">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="first_name">First Name <span class="text-danger">*</span></label>
                <input type="text" name="first_name" id="first_name" class="form-control-valo"
                    value="{{ old('first_name', $user->first_name) }}">
                @error('first_name')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                <input type="text" name="last_name" id="last_name" class="form-control-valo"
                    value="{{ old('last_name', $user->last_name) }}">
                @error('last_name')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control-valo"
                    value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="role_id">Role <span class="text-danger">*</span></label>
                <select name="role_id" id="role_id" class="form-select-valo" @if(auth()->id() === $user->id) disabled @endif>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>

                {{-- si c'est lui-même → on garde la valeur via un input hidden --}}
                @if(auth()->id() === $user->id)
                    <input type="hidden" name="role_id" value="{{ $user->role_id }}">
                @endif

                @error('role_id')
                    <div class="text-danger small fst-italic mt-1">{{ $message }}</div>
                @enderror
            </div>

            <p class="required-note">All fields marked with <span class="text-danger">*</span> are required.</p>

            <div class="d-flex gap-3 mt-3">
                <button type="submit" class="btn-valo warning">Update</button>
                <a href="{{ route('back.user.index') }}" class="btn-valo info">Cancel</a>
            </div>
        </form>
    </div>
@endsection