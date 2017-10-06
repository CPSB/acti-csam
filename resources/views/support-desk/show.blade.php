@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><code>#T{{ $ticket->id }}</code></strong>
                        {{ ucfirst($ticket->subject) }}

                        <div class="pull-right">
                            <a href="" class="btn btn-primary btn-xs">
                                <span class="fa fa-pencil" aria-hidden="true"></span> Wijzig
                            </a>

                            @can('delete', $ticket)
                                <a href="" class="btn btn-xs btn-danger">
                                    <span class="fa fa-trash" aria-hidden="true"></span> Verwijder
                                </a>
                            @endcan
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-md-3"><strong>Creator:</strong></div>
                                        <div class="col-md-3">{{ $ticket->author->name }}</div>

                                        <div class="col-md-3"><strong>Assignee:</strong></div>
                                        <div class="col-md-3">{{ $ticket->assignee->name }}</div>

                                        <div class="col-md-3"><strong>Status:</strong></div>
                                        <div class="col-md-3">
                                            <span style="color: {{ $ticket->status->color }};">
                                                {{ $ticket->status->name }}
                                            </span>
                                        </div>

                                        <div class="col-md-3"><strong>Category:</strong></div>
                                        <div class="col-md-3">
                                            <span style="color: {{ $ticket->category->color }};">
                                                {{ $ticket->category->name }}
                                            </span>
                                        </div>

                                        <div class="col-md-3"><strong>Priority:</strong></div>
                                        <div class="col-md-3">{{ $ticket->priority->name }}</div>

                                        <div class="col-md-3"><strong>Created:</strong></div>
                                        <div class="col-md-3">{{ $ticket->created_at->diffForHumans() }}</div>

                                        <div class="col-md-offset-6 col-md-3"><strong>Last Update:</strong></div>
                                        <div class="col-md-3">{{ $ticket->updated_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12"> {{ $ticket->description }} </div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <div class="blog-comment">
                            <ul class="comments">
                                @php $comments = $ticket->comments()->paginate(5); @endphp

                                @foreach ($comments as $comment)
                                    <li class="clearfix">
                                        <img src="https://bootdey.com/img/Content/user_1.jpg" class="avatar img-responsive" alt="">
                                        <div class="post-comments">

                                            <p class="meta">
                                                {{ $comment->created_at->diffForHumans()}} <a href="#">{{ $comment->author->name }}</a> says:

                                                <span class="pull-right">

                                                    @can('delete', $comment)
                                                        <a class="btn btn-danger btn-xs" href="{{ route('comments.delete', $comment) }}">
                                                            <small>
                                                                <span class="fa fa-close" aria-hidden="true"></span> Delete
                                                            </small>
                                                        </a>
                                                    @endcan
                                                </span>
                                            </p>
                                            <p>{{ $comment->message }}</p>
                                        </div>
                                    </li>
                                @endforeach

                                {{  $comments->render() }} {{-- Pagination instance for the comments. --}}

                                <li class="clearfix"> {{-- reaction box --}}
                                    <img src="https://bootdey.com/img/Content/user_1.jpg" class="avatar img-responsive" alt="">
                                    <div class="post-comments">
                                        <p class="meta">{{ $user->name }}:</p>

                                        <form class="form-horizontal" method="POST" action="{{  route('comments.store', $ticket) }}">
                                            {{ csrf_field() }} {{-- CSRF form protection --}}

                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <textarea style="resize: none;" name="message" class="form-control" rows="3" placeholder="Uw reactie."></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <span class="fa fa-check" aria-hidden="true"></span> Comment
                                                    </button>
                                                    <button type="reset" class="btn btn-sm btn-danger">
                                                        <span class="fa fa-undo" aria-hidden="true"></span> Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li> {{-- /Reaction box --}}

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection