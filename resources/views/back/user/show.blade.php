@extends('layouts.back')

@section('title', 'User Details')

@section('content')
    <div class="page-player">

        <h1 class="table-title">
            User Profile
            <span class="table-title-name">{{ $user->first_name }} {{ $user->last_name }}</span>
        </h1>

        <div class="table-header">
            <a href="{{ route('back.user.index') }}" class="btn-valo small">Back</a>
            <a href="{{ route('back.user.edit', $user->id) }}" class="btn-valo small info">Edit</a>
        </div>

        <div class="player-show-container" style="display:flex; gap:2rem;">
            <div class="player-infos" style="flex:1;">
                <table class="table-not-bootstrap" style="margin:0">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>First Name</th>
                            <td>{{ $user->first_name }}</td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td>{{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>
                                @if($user->role)
                                    <span class="badge info">{{ $user->role->name }}</span>
                                @else
                                    <span class="text-gray">No Role</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Email Verified</th>
                            <td>
                                @if($user->email_verified_at)
                                    <span class="badge success">Yes ({{ $user->email_verified_at->format('d/m/Y H:i') }})</span>
                                @else
                                    <span class="badge secondary">No</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created at</th>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Updated at</th>
                            <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>

                {{-- Teams Created by User --}}
                @if($user->equipe && $user->equipe->count() > 0)
                    <table class="table-not-bootstrap mt-4">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Team Name</th>
                                <th>City</th>
                                <th>Continent</th>
                                <th>Gender</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->equipe as $equipe)
                                <tr>
                                    <td class="table-img">
                                        <div class="table-img">
                                            <img
                                                src="{{ $equipe->src ? asset('storage/' . $equipe->src) : 'https://placehold.co/50x50' }}">
                                        </div>
                                    </td>
                                    <td>{{ $equipe->name }}</td>
                                    <td>{{ $equipe->city }}</td>
                                    <td>{{ $equipe->continent?->name ?? 'Not defined' }}</td>
                                    <td>
                                        @if($equipe->genre?->name === 'male')
                                            <span class="badge info">Male Team</span>
                                        @elseif($equipe->genre?->name === 'female')
                                            <span class="badge info">Female Team</span>
                                        @else
                                            <span class="badge info">Mixed Team</span>
                                        @endif
                                    </td>
                                    <td>{{ $equipe->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('back.equipe.show', $equipe->id) }}" class="btn-valo small info">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                {{-- Players Created by User --}}
                @if($user->joueur && $user->joueur->count() > 0)
                    <table class="table-not-bootstrap mt-4">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Position</th>
                                <th>Team</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->joueur as $joueur)
                                <tr>
                                    <td>
                                        <div class="table-img">
                                            <img
                                                src="{{ $joueur->photo?->src ? asset('storage/' . $joueur->photo->src) : 'https://placehold.co/50x50' }}">
                                        </div>
                                    </td>
                                    <td class="break">{{ $joueur->first_name }}</td>
                                    <td class="break">{{ $joueur->last_name }}</td>
                                    <td>{{ ucfirst($joueur->position?->name) ?? 'Not defined' }}</td>
                                    <td>{{ $joueur->equipe?->name ?? 'No Team' }}</td>
                                    <td>
                                        <a href="{{ route('back.joueur.show', $joueur->id) }}" class="btn-valo small info">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection