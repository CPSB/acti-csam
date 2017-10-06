@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="fa fa-plus" aria-hidden="true"></span> Categorie toevoegen
                    </div>

                    <div class="panel-body">

                        <form method="POST" class="form-horizontal" action="{{ route('category.store') }}">
                            {{ csrf_field() }} {{-- CSRF form filed protection --}}

                            <div class="form-group @error('name', 'has-error')">
                                <label class="col-md-2 control-label">
                                    Categorie naam: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Naam van de categorie" @input('name')>
                                    @error('name')
                                </div>
                            </div>

                            <div class="form-group @error('color', 'has-error')">
                                <label class="col-md-2 control-label">
                                    Categorie kleur: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-6">
                                    <input type="color" class="form-control" placeholder="De kleur van de categorie" @input('color')>
                                    @error('color')
                                </div>
                            </div>

                            <div class="form-group @error('description', 'has-error')">
                                <label class="col-md-2 control-label">
                                    Cat. beschrijving: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-6">
                                     <textarea name="description" placeholder="De beschrijving van het label." class="form-control" rows="7">@text('description')</textarea>

                                    @error('description')
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-6">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <span class="fa fa-check" aria-hidden="true"></span> Invoegen
                                    </button>

                                    <button type="reset" class="btn btn-link btn-sm">
                                        <span class="fa fa-undo" aria-hidden="true"></span> Annuleren
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection