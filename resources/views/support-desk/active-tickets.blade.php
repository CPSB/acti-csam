<div class="panel panel-default">
    <div class="panel-heading">
        <span class="fa fa-list" aria-hidden="true"></span> Active tickets.

        <a href="" class="btn btn-xs btn-primary pull-right">
            <span class="fa fa-plus" aria-hidden="true"></span> Ticket toevoegen
        </a>
    </div>

    <div class="panel-body">
        @if ($activeTickets->count() > 0) {{-- There are open tickets found --}}
            @php $openTickets = $activeTickets->paginate(20); @endphp

            <table class="table table-condensed table-hover table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Creator</th>
                        <th>Category</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($openTickets as $openTicket) {{-- Loop through tickets. --}}
                        <tr>
                            <td><strong>#{!! $openTicket->id !!}</strong></td>
                            <td>
                                <a href="{{ route('support.show', $openTicket) }}">
                                    {{ str_limit($openTicket->subject, 20) }}
                                    @if (strlen($openTicket->subject > 0)) ... @endif
                                </a>
                            </td>
                            <td>{{-- Priority relation not created --}}</td>
                            <td>
                                <span style="color: {{ $openTicket->status->color }};">
                                    {{ $openTicket->status->name }}
                                </span>
                            </td>
                            <td>{{ $openTicket->author->name }}</td>
                            <td>
                                <span style="color: {{ $openTicket->category->color }};">
                                    {{ $openTicket->category->name }}
                                </span>
                            </td>
                            <td>{{ $openTicket->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else {{-- No open tickets found. --}}
        @endif
    </div>
</div>