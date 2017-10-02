<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\SupportdeskValidator;
use Illuminate\Http\Request;
use ActivismeBE\Repositories\{
    SupportDeskRepository, PriorityRepository, CategoryRepository, StatusRepository, UsersRepository
};
use Illuminate\View\View;

/**
 * Class SupportDeskController 
 * 
 * @author  Tim Joosten 
 * @license MIT License
 * @package ActivismeBE\Http\Controllers
 */
class SupportDeskController extends Controller
{
    private $supportDesk; /** @var SupportDeskRepository $supportDesk */
    private $priorities;  /** @var PriorityRepository    $priorities  */
    private $categories;  /** @var CategoryRepository    $categories  */
    private $statusses;   /** @var StatusRepository      $statusses   */
    private $users;       /** @var UsersRepository       $users       */

    /**
     * SupportDeskController constructor
     *
     * @param  SupportDeskRepository $supportDesk The abstraction layer for the support tickets DB table.
     * @param  PriorityRepository    $priorities  The abstraction layer for the support ticket priorities.
     * @param  CategoryRepository    $categories  The abstraction layer for the support ticket categories.  
     * @param  StatusRepository      $statusses   The abstraction layer for the support ticket Statusses.
     * @param  UsersRepository       $users       The abstraction layer for the users in the system.
     *
     * @return void
     */
    public function __construct(
        SupportDeskRepository   $supportDesk, 
        PriorityRepository      $priorities, 
        CategoryRepository      $categories, 
        StatusRepository        $statusses,
        UsersRepository         $users
    ) {
        $this->middleware('auth');
        //! $this->middleware('role:admin');         // TODO: Implement and register middleware.
        //! $this->middleware('forbid-banned-user'); // TODO: Implement and register middleware.

        $this->supportDesk = $supportDesk;
        $this->priorities  = $priorities;
        $this->categories  = $categories; 
        $this->statusses   = $statusses;
        $this->users       = $users;
    }

    /**
     * Get the support-desk dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(): View
    {
        return view('support-desk.index', [
            'assignedTickets' => $this->supportDesk->assignedTickets(auth()->user()->id),
        ]); 
    }

    /**
     * Display a specific ticket in the database.
     *
     * @param  string $ticketId The id form the ticket in the storage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($ticketId): View
    {
        // TODO: Build up and register the view.
        // TODO: Register ->getTicket(); In the support repository.

        $ticket = $this->supportDesk->getTicket($ticketId) ?: abort(404);
        return view('support-desk.show', compact('ticket'));
    }

    /**
     * The create view for new support tickets.
     *
     * @todo    Only admins can pick tickets or can be assigned to tickets. ( ->getAdmins(); )
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function create(): View
    {
        $columns = ['id', 'name'];

        return view('support-desk.create', [
            'priorities' => $this->priorities->all($columns),
            'statusses'  => $this->statusses->all($columns),
            'categories' => $this->categories->all($columns),
            'assignee'   => $this->users->getAdmins(),
        ]);
    }

    /**
     * Store a new support desk in the application.
     *
     * @param SupportdeskValidator $input The user given input (validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SupportdeskValidator $input)
    {
        // TODO: Fill-in the validator instance.
        // TODO: Write out the logic.
        // TODO: Register the route.
        // TODO: Redirect the user back to the previous page.

        dd($input->all()); //! Dump the input for now because we have no logic defined.
    }
}
