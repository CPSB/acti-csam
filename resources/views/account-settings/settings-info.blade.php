<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Account informatie:</div>

            <div class="panel-body">

                <form class="form-horizontal" action="{{ route('account.settings.info') }}" method="POST" enctype="multipart/form-data"> {{-- Update form --}}
                    {{ csrf_field() }} {{-- CSRF form field protection --}}

                    <div class="form-group @error('name', 'has-error')">
                        <label class="control-label col-md-3">
                            Uw naam: <span class="text-danger">*</span>
                        </label>

                        <div class="col-md-9">
                            <input type="text" placeholder="Uw naam" class="form-control" @input('name', $user->name)>
                            @error('name')
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="avatar" class="control-label col-sm-3">
                            Avatar: <!-- <span class="text-danger">*</span> -->
                        </label>

                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="userImage" id="avatar">
                        </div>
                    </div>

                    <div class="form-group @error('email', 'has-error')">
                        <label class="control-label col-md-3">
                            Uw email adres: <span class="text-danger">*</span>
                        </label>

                        <div class="col-md-9">
                            <input type="email" placeholder="Uw email adres" class="form-control" @input('email', $user->email)>
                            @error('email')
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-sm btn-success">
                                <span class="fa fa-check" aria-hidden="true"></span> Aanpassen
                            </button>

                            <button type="reset" class="btn btn-sm btn-link">
                                <span class="fa fa-unfo" aria-hidden="true"></span> Annuleren
                            </button>
                        </div>
                    </div>
                </form> {{-- /Update form --}}

            </div>
        </div>
    </div>
</div>