@extends('layouts.app')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash message instance --}}

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="fa fa-plus" aria-hidden="true"></span> Gebruiker toevoegen
                    </div>

                    <div class="panel-body">

                        <form method="POST" action="" class="form-horizontal">
                            {{ csrf_field() }} {{-- CSRF form field protection --}}

                            <div class="form-group @error('name', 'has-error')">
                                <label class="control-label col-md-2">
                                    Naam: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input @input('name') placeholder="De naam van de gebruiker" type="text" class="form-control">
                                    @error('name')
                                </div>
                            </div>

                            <div class="form-group @error('email', 'has-error')">
                                <label class="control-label col-md-2">
                                    E-mail adres: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input type="email" placeholder="Het email adresv/d gebruiker" @input('email') class="form-control">
                                    @error('email')
                                </div>
                            </div>

                            <div class="form-group @error('language', 'has-error')">
                                <label class="control-label col-md-2">
                                    Taal: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-6">
                                    <select class="form-control" @input('language')>
                                        <option valie="">-- Selecteer de gebruiker zijn taal --</option>
                                        <option value="nl">Nederlands</option>
                                        <option value="fr">Frans</option>
                                        <option value="en">Engels</option>
                                    </select>

                                    @error('language')
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <button class="btn btn-success btn-sm" type="submit">
                                        <span class="fa fa-check" aria-hidden="true"></span> Aanmaken
                                    </button>

                                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-link">
                                        <span class="fa fa-undo" aria-hidden="true"></span> Annuleren
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection