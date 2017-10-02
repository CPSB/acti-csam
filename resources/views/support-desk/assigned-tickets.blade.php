<div class="panel panel-default">
    <div class="panel-heading">
        Tickets assigned to {{ $user->name }}

        <a href="{{ route('support.create') }}" class="pull-right btn btn-xs btn-primary">
            <span class="fa fa-plus" aria-hidden="true"></span> Ticket toevoegen
        </a>
    </div>

    <div class="panel-body">
        @if ($assignedTickets->count() > 0) {{-- Assigned tickets found --}}
            @php $assignedGroup = $assignedTickets->paginate(20) @endphp

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
                    @foreach ($assignedGroup as $assignedTicket)
                        <tr>
                            <td>#{{ $assignedTicket->id }}</td>
                            <td>
                                <a href="{{ route('support.show', $assignedTicket) }}">
                                    {{ str_limit($assignedTicket->subject, 20) }}
                                    @if (strlen($assignedTicket->subject > 0)) ... @endif
                                </a>
                            </td>
                            <td>
                                <span style="color: {{ $assignedTicket->status->color }};">
                                    {{ $assignedTicket->status->name }}
                                </span>
                            </td>
                            <td>{{ $assignedTicket->assignee->name }}</td>
                            <td>
                                <span style="color: {{ $assignedTicket->category->color }};">
                                    {{ $assignedTicket->category->name }}
                                </span>
                            </td>
                            <td>{{ $assignedTicket->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $assignedGroup->render() }} {{-- Pagination instance --}}
        @else {{-- No assigned tickets found --}}
            <div class="alert alert-success" role="alert">
                <strong>Info:</strong> Er zijn geen toegewezen ticketten voor je.
            </div>
        @endif
    </div>
</div>