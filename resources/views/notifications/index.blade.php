@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group" id="activeTabs">
                    <a class="list-group-item" href="#unread" aria-controls="all" role="tab" data-toggle="tab">
                        Ongelezen notificaties
                    </a>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="fa fa-bell" aria-hidden="true"></span> Notifications

                        @if (count($user->unreadNotifications) > 0)
                            <a href="{{ route('notifications.read.all') }}" class="btn btn-xs btn-danger pull-right">
                                Markeer alles als gelezen.
                            </a>
                        @endif
                    </div>

                    <div class="panel-body">
                        <div class="notifications-container">
                            <div class="header">
                                <h4>Notifications</h4>
                            </div>
                            <ul>
                                @if (count($user->unreadNotifications) == 0) {{-- User has no unread notifications --}}
                                    <li class="notification info">
                                        <div class="icon">
                                            <span class="fa fa-square-o" aria-hidden="true"></span>
                                        </div>

                                        <div class="content">
                                            <div>Er zijn geen nieuwe notificaties gevonden!</div>
                                            <small>- een paar seconden geleden</small>
                                        </div>
                                    </li>
                                @else {{-- There are new notifications. --}}
                                    @php ($unreads = $user->unreadNotifications()->paginate(15))

                                    @foreach ($unreads as $notification)
                                        <li onclick="location.href='{{ route('notifications.read', $notification) }}';" class="notification {{ $notification->type }}">
                                            <div class="icon">
                                                <i class="fa fa-check-square-o"></i>
                                            </div>

                                            <div class="profile-image">
                                                <img src="{{ $notification->data['avatar'] }}">
                                            </div>

                                            <div class="content">
                                                <div>{{ $notification->data['message'] }}</div>
                                                <small>{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>

                                            <div class="icon-group">
                                                <a href="{{ route('notifications.read', $notification) }}">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                {!! $unreads->render() !!}
            </div>
        </div>
    </div>
@endsection