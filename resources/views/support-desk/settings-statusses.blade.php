<div class="panel panel-default">
    <div class="panel-heading">
        Support ticket statusses:

        <a href="" class="pull-right btn btn-xs btn-primary btn-sprimary">
            <span class="fa fa-plus" aria-hidden="true"></span> Add status
        </a>
    </div>

    <div class="panel-body">
        @php $dbStatuses = $statuses->paginate(20); @endphp

        @if ($statuses->count() > 0) {{-- There are statuses found --}}
            <table class="table table-condensed table-hover table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Creator:</th>
                        <th>Name</th>
                        <th colspan="2">Description</th> {{-- Colspan="2" needed for the functions --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dbStatuses as $status) {{-- Loop through the statuses --}}
                        <tr>
                            <td><strong>#{{ $status->id }}</strong></td>
                            <td>
                                @if (empty($status->author->name))
                                    Onbekende persoon
                                @else
                                    {{ $status->author->name }}
                                @endif
                            </td>
                            <td><span style="color: {{ $status->color }}">{{ $status->name }}</span></td>
                            <td>{{ $status->description }}</td>

                            <td class="text-right"> {{-- Options --}}
                                @if (! in_array($status->name, ['open', 'pending', 'fixed', 'closed']))
                                    <a href="" class="label label-default">Wijzig</a>
                                    <a href="" class="label label-danger">Verwijder</a>
                                @endif
                            </td> {{-- /Options --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else {{-- No statuses found --}}
            <div class="alert alert-warning" role="alert">
                <strong>Waarschuwing:</strong> Er zijn geen ticket statussen gevonden in het systeem.
            </div>
        @endif
    </div>
</div>