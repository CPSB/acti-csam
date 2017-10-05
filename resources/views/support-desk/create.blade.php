@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- TODO: Implementatie flash session instance. --}}

        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="fa fa-info-circle" aria-hidden="true"></span> Nieuw helpdesk ticket.
                    </div>

                    <div class="panel-body"> {{-- Ticket form --}}
                        <form action="{{ route('support.store') }}" method="POST" class="form-horizontal">
                            {{ csrf_field() }} {{-- CSRF Form protection --}}

                            <div class="form-group"> {{-- Title form group --}}
                                <label class="control-label col-md-3">
                                    Onderwerp: <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <input type="text" name="subject" class="form-control" placeholder="Titel van het probleem.">
                                </div>
                            </div> {{-- /Title form group --}}

                            <div class="form-group"> {{-- Category form-group --}}
                                <label class="control-label col-md-3">
                                    Categorie: <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select name="category_id" class="form-control">
                                        <option value="">Geen categorie geselecteerd</option>

                                        @foreach ($categories as $category) {{-- Loop trough to the categories --}}
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> {{-- /Category form-group --}}

                            <div class="form-group"> {{-- Discription form-group --}}
                                <label class="control-label col-md-3">
                                    Beschrijving: <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-9">
                                    <textarea name="description" placeholder="Waarmee kunnen we je helpen?" rows="7" class="form-control"></textarea>
                                    <small class="help-block">Dit veld is markdown ondersteund.</small>
                                </div>
                            </div> {{-- /Description form-group --}}

                            <div class="form-group"> {{-- Form options --}}
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <span class="fa fa-check" aria-hidden="true"></span> Opslaan
                                    </button>

                                    <button type="reset" class="btn btn-sm btn-danger">
                                        <span class="fa fa-undo" aria-hidden="true"></span> Annuleren
                                    </button>
                                </div>
                            </div> {{-- /END form options --}}
                        </form>

                    </div> {{-- /Ticket form --}}
                </div>
            </div>
        </div>
    </div>
@endsection