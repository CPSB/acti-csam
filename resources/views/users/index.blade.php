@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- TODO: Implement flash session instance. --}}

        <div class="row">
            <div class="col-md-9"> {{-- User overview. --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="fa fa-users" aria-hidden="true"></span> Gebruikers overzicht.
                    </div>

                    <div class="panel-body">
                        @if ($users->count() > 0) {{-- Users found --}}
                            @php $userBase = $users->paginate(20) @endphp

                            <table class="table table-condensed table-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Naam:</th>
                                        <th>Email:</th>
                                        <th colspan="2">Aangemaakt op:</th> {{-- Colspan 2 is nodig voor de functies --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userBase as $user) {{-- loop through the users.  --}}
                                        <tr>
                                            <td><strong>#{{ $user->id }}</strong></td>
                                            <td>{{ $user->name }}</td>
                                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="" class="label label-info">Bekijk</a>
                                                <a href="" class="label label-danger">Blokkeer</a>
                                                <a href="" class="label label-danger">Verwijder</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $userBase->render() }} {{-- Pagination instance --}}
                        @else {{-- Else inserted because shared view with the search function. --}}
                            <div class="alert alert-info" role="alert">
                                <strong>Info:</strong>
                                Er zijn geen gebruikers met de volgende zoekterm: '{{ $term }}'.
                            </div>
                        @endif
                    </div>
                </div>
            </div> {{-- /User overview. --}}

            <div class="col-md-3"> {{-- Option sidenav --}}
                <div class="well well-sm"> {{-- Search form --}}
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="text" name="term" class="form-control" placeholder="Zoek gebruiker">
                            <span class="input-group-btn">
                            <button class="btn btn-danger" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </span>
                        </div>
                    </form>
                </div> {{-- /Search form --}}

                <div class="list-group" id="activeTabs">
                    <a href="{{ route('users.index') }}" class="list-group-item">
                        Geregistreerde gebruikers.
                        <span class="pull-right badge">{{ $users->count() }}</span>
                    </a>

                    <a href="" class="list-group-item">
                        Gebruiker toevoegen.
                    </a>
                </div>
            </div> {{-- /Option sidenav --}}
        </div>
    </div>
@endsection
