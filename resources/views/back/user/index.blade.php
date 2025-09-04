@extends('layouts.back')

@section('title', 'Users')

@section('content')
<div class="page-user">
    <h1 class="table-title">Users</h1>

    <div class="table-header">
        <h2>Users List</h2>
    </div>

    @if(session('success'))
        <div class="alert-success-valo">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-not-bootstrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Email Verified</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role)
                            <span class="badge info">{{ $user->role->name }}</span>
                        @else
                            <span class="text-gray">No Role</span>
                        @endif
                    </td>
                    <td>
                        @if($user->email_verified_at)
                            <span class="badge secondary">Yes</span>
                        @else
                            <span class="badge info">No</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('back.user.show', $user->id) }}" class="btn-valo small info">View</a>
                            <a href="{{ route('back.user.edit', $user->id) }}" class="btn-valo small warning">Edit</a>
                            <form method="POST" action="{{ route('back.user.delete', $user->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-valo small danger" 
                                    onclick="return confirm('Are you sure you want to delete {{ $user->first_name }} {{ $user->last_name }}?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="table-empty">No users found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
