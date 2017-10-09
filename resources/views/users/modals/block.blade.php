{{-- Report reaction modal --}}
<div class="modal fade" id="block_user" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h4 class="modal-title" id="myModalLabel">Blokkeer een gebruiker.</h4>
            </div>

            <div class="modal-body form">
                <form action="{{ route('users.block') }}" id="form" method="POST" class="form-horizontal">
                    {{ csrf_field() }} {{-- CSRF --}}

                    <input type="hidden" value="" name="userId"/>

                    <div class="form-body">

                        {{-- Reaction content input-group. --}}
                        <div class="form-group">
                            <label class="control-label col-sm-3">Gebruiker: </label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="" disabled>
                            </div>
                        </div>

                        {{-- Reason reaction input --}}
                        <div class="form-group">
                            <label class="control-label col-sm-3">
                                Reden: <span class="text-danger">*</span>
                            </label>

                            <div class="col-sm-9">
                                <textarea rows="5" placeholder="Reden van de de blokkering" class="form-control" name="reason"></textarea>
                            </div>
                        </div>

                        {{-- Submit and reset group  --}}
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-8">
                                <button type="submit" class="btn btn-sm btn-success">Rapporteer</button>
                                <button type="reset" class="btn btn-sm btn-danger" data-dismiss="modal">Annuleer</button>
                            </div>
                        </div>

                    </div>

                </form>
            </div>

        </div>{{-- /.modal-content --}}
    </div>{{-- /.modal-dialog --}}
</div>{{-- /.modal --}}
{{-- /Report reaction modal --}}