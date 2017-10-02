@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- TODO: Implementation flash session instance. --}}

        <div class="row">
        
            <div class="col-md-12"> {{-- The support desk navigation --}}
                <div class="panel panel-default">
                    <div class="panel-body">

                        <ul class="nav nav-pills">
                            <li role="presentation" class="active">
                                <a href="#assigned" aria-controls="assigned" role="tab" data-toggle="tab">
                                    Assigned Tickets <span class="badge">{{ $assignedTickets->count() }}</span>
                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#active" aria-controls="active" role="tab" data-toggle="tab">
                                    Active Tickets <span class="badge">0</span>
                                </a>
                           </li>

                           <li role="presentation">
                                <a href="#completed" aria-controls="completed" role="tab" data-toggle="tab">
                                    Completed tickets <span class="badge">0</span>
                                </a>
                           </li> 

                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    Settings <span class="caret"></span>
                                </a>
    
                                <ul class="dropdown-menu">
                                    <li><a href="">Statuses</a></li>
                                    <li><a href="">Priorities</a></li>
                                    <li><a href="">Categories</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </div> {{-- /Support desk navigation --}}

            <div class="col-md-12"> {{-- Menu panels --}}
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="assigned">   @include('support-desk.assigned-tickets')  </div>
                    <div role="tabpanel" class="tab-pane fade in"        id="active">     @include('support-desk.active-tickets')    </div>
                    <div role="tabpanel" class="tab-pane fade in"        id="completed">  @include('support-desk.completed-tickets') </div>
                </div>
            </div> {{-- /Menu panels --}}            

        </div>
    </div>
@endsection