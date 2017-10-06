<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Account beveiliging</div>

            <div class="panel-body">

                <form action="{{ route('account.settings.security')  }}" class="form-horizontal" method="POST"> {{-- Account security form --}}
                    {{ csrf_field() }} {{-- CSRF field protection. --}}

                    <div class="form-group @error('password', 'has-error')">
                        <label class="control-label col-md-3">
                            Wachtwoord: <span class="text-danger">*</span>
                        </label>

                        <div class="col-md-9">
                            <input type="password" class="form-control" placeholder="Uw nieuw wachtwoord." @input('password')>
                            @error('password')
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">
                            Herhaal wachtwoord: <span class="text-danger">*</span>
                        </label>

                        <div class="col-md-9">
                            <input type="password" class="form-control" placeholder="Herhaal uw wachtwoord" name="password_confirmation">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-sm btn-success">
                                <span class="fa fa-check" aria-hidden="true"></span> Aanpassen
                            </button>

                            <button type="reset" class="btn btn-sm btn-link">
                                <span class="fa fa-undo" aria-hidden="true"></span> Annuleren
                            </button>
                        </div>
                    </div>
                </form> {{-- /Account security form --}}

            </div>
        </div>
    </div>
</div>