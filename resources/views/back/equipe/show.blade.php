@extends('layouts.back')

@section('title', 'Team Details')

@section('content')
    <div class="page-team">

        <h1 class="table-title">Team Profile <span class="table-title-name">{{ $equipe->name }}</span></h1>

        <div class="table-header">
            <a href="{{ route('back.equipe.index') }}" class="btn-valo small">Back</a>

            @can('update-equipe', $equipe)
                <a href="{{ route('back.equipe.edit', $equipe->id) }}" class="btn-valo small info">Edit</a>
            @endcan
        </div>

        <div class="team-show-container" style="display:flex; gap:2rem;">
            <div class="table-img" style="width: 400px; height: 400px; border-radius: 0;">
                <img src="{{ $equipe?->src ? asset('storage/' . $equipe->src) : 'https://placehold.co/400x400' }}" alt="">
            </div>

            <div class="team-infos" style="flex:1;">
                <table class="table-not-bootstrap" style="margin:0">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @can('isAdmin')
                            <tr>
                                <td>ID</td>
                                <td>{{ $equipe->id }}</td>
                            </tr>
                            <tr>
                                <td>Created by User</td>
                                <td>{{ $equipe->user?->first_name ?? 'N/A' }}</td>
                            </tr>
                        @endcan

                        <tr>
                            <td>Name</td>
                            <td>{{ $equipe->name }}</td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>{{ $equipe->city }}</td>
                        </tr>
                        <tr>
                            <td>Continent</td>
                            <td>{{ $equipe->continent?->name ?? 'Not defined' }}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>
                                @if($equipe->genre?->name === 'male')
                                    <span class="badge info">Male Team</span>
                                @elseif($equipe->genre?->name === 'female')
                                    <span class="badge info">Female Team</span>
                                @else
                                    <span class="badge info">Mixed Team</span>
                                @endif
                            </td>
                        </tr>

                        @can('isAdmin')
                            <tr>
                                <td>Created at</td>
                                <td>{{ $equipe->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td>Updated at</td>
                                <td>{{ $equipe->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endcan
                    </tbody>
                </table>

            </div>
        </div>

        @if($equipe->joueur && $equipe->joueur->count() > 0)
            <table class="table-not-bootstrap mt-4">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($equipe->joueur->count() > 0)
                        <tr class="separator">
                            <td colspan="4" class="text-center text-gray">Main Team</td>
                        </tr>
                    @endif

                    @forelse($equipe->joueur->take(5) as $joueur)
                        <tr>
                            <td>
                                <div class="table-img" style="width:50px; height:50px;">
                                    <img
                                        src="{{ $joueur->photo?->src ? asset('storage/' . $joueur->photo->src) : 'https://placehold.co/50x50' }}">
                                </div>
                            </td>
                            <td>{{ $joueur->last_name }} {{ $joueur->first_name }}</td>
                            <td>
                                @if($joueur->position)
                                    <span class="badge info">{{ $joueur->position->name }}</span>
                                @else
                                    <span class="text-gray">Not defined</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('back.joueur.show', $joueur->id) }}" class="btn-valo small info">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="table-empty">No players in this team</td>
                        </tr>
                    @endforelse

                    @if($equipe->joueur->count() > 5)
                        <tr class="separator">
                            <td colspan="4" class="text-center text-gray">Reserve</td>
                        </tr>
                        @foreach($equipe->joueur->slice(5) as $joueur)
                            <tr>
                                <td>
                                    <div class="table-img" style="width:50px; height:50px;">
                                        <img
                                            src="{{ $joueur->photo?->src ? asset('storage/' . $joueur->photo->src) : 'https://placehold.co/50x50' }}">
                                    </div>
                                </td>
                                <td>{{ $joueur->last_name }} {{ $joueur->first_name }}</td>
                                <td>
                                    @if($joueur->position)
                                        <span class="badge info">{{ $joueur->position->name }}</span>
                                    @else
                                        <span class="text-gray">Not defined</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('back.joueur.show', $joueur->id) }}" class="btn-valo small info">View</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @endif
    </div>
@endsection