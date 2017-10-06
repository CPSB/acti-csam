<div class="panel panel-default">

    <div class="panel-heading"> {{-- The panel-heading --}}
        Ticket categorieen.

        <a class="btn btn-xs btn-primary pull-right" href="{{ route('category.create') }}">
            <span class="fa fa-plus" aria-hidden="true"></span> Categorie toevoegen
        </a>
    </div>{{-- /Panel heading --}}

    <div class="panel-body">
        @php $dbCategories = $categories->paginate(20); @endphp

        @if ($categories->count() > 0) {{-- There are categories found in the system. --}}
            <table class="table table-hover table-condensed table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Autheur:</th>
                        <th>Naam:</th>
                        <th colspan="2">Beschrijving</th> {{-- colspan="2" is nodig voor de functies. --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dbCategories as $category) {{-- Loop through the categories --}}
                        <tr>
                            <td><strong>#{{ $category->id }}</strong></td>
                            <td>{{ $category->author->name }}</td>
                            <td>
                                <span style="color: {{ $category->color }};">
                                    {{ $category->name }}
                                </span>
                            </td>
                            <td>{{ $category->description }}</td>
                            <td class="text-right">
                                <a href="{{ route('category.edit', $category) }}" class="label label-primary">Wijzig</a>
                                <a href="" class="label label-danger">Verwijder</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $dbCategories->render() }} {{-- Categories database relations. --}}
        @else {{-- No categories found in the database. --}}
            <div class="alert alert-warning" role="alert">
                <strong>Info:</strong> Er zijn geen ticket categorieen gevonden in het systeem.
            </div>
        @endif
    </div>

</div>