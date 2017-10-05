@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"> {{-- Sidebar --}}
                <div class="list-group" id="activeTabs">
                    <a class="list-group-item" href="#info" aria-controls="messages" role="tab" data-toggle="tab">
                        Account informatie
                    </a>

                    <a class="list-group-item" href="#security" aria-controls="messages" role="tab" data-toggle="tab">
                        Account beveiliging
                    </a>
                </div>

                <div class="list-group"> {{-- Account deleting --}}
                    <a class="list-group-item list-group-item-danger">
                        <span class="fa fa-trash" aria-hidden="true"></span> Verwijder account
                    </a>
                </div> {{-- /Account deleting --}}
            </div> {{-- /Sidebar --}}

            <div class="col-md-9"> {{-- Settings view. --}}
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="info"> @include('account-settings.settings-info')     </div>
                    <div role="tabpanel" class="tab-pane" id="security">    @include('account-settings.settings-security') </div>
                </div>
            </div> {{-- /Settings view --}}
        </div>
    </div>
@endsection