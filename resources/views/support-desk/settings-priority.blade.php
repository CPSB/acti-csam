<div class="panel panel-default">
    <div class="panel-heading">
        <span class="fa fa-tags" aria-hidden="true"></span> Prioriteiten ticketten:

        <div class="pull-right">
            <a class="btn btn-xs btn-primary" href="">
                <span class="fa fa-plus" aria-hidden="true"></span> Prioriteit toevoegen.
            </a>
        </div>
    </div>

    <div class="panel-body">
        @if ($priorities->count() > 0) {{-- Priorities found in the system --}}
            @php $dbPriorities = $priorities->paginate(20) @endphp

            <table class="table table-condensed table-responsive table-hover">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Autheur:</td>
                        <td>Naam:</td>
                        <td colspan="2">Beschrijving:</td> {{-- Colspan="2" is nodig voor de functies. --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dbpriorities as $priority) {{-- Loop through the priorities --}}
                        <tr>
                            <td><strong>#{{ $priority->id }}</strong></td>
                            <td>{{ $priority->author->name }}</td>
                            <td>
                                <span style="color: {{ $priority->color }}">
                                    {{ $priority->name }}
                                </span>
                            </td>
                            <td>{{ $priority->description }}</td>
                            <td class="pull-right"> {{-- Options --}}
                                <a href="" class="label label-primary">Wijzig</a>
                                <a href="" class="label label-danger">Verwijder</a>
                            </td> {{-- /Options --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else {{-- No priorities found in the system.  --}}
            <div class="alert alert-warning" role="alert">
                <strong>Info:</strong> Er zijn geen ticket prioriteiten gevonden in het systeem.
            </div>
        @endif
    </div>
</div>