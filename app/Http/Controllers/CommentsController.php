<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\CommentValidator;
use ActivismeBE\Repositories\CommentsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class CommentsController
 *
 * @package ActivismeBE\Http\Controllers
 */
class CommentsController extends Controller
{
    private $commentsRepository; /** @var CommentsRepository $commentsRepository */

    /**
     * CommentsController constructor.
     *
     * @param  CommentsRepository $commentsRepository The abtraction layer between controller and ORM.
     * @return void
     */
    public function __construct(CommentsRepository $commentsRepository)
    {
        $this->middleware('auth');
        // this->middleware('forbid-banned-user'); // TODO: Build up dat register middleware.

        $this->commentsRepository = $commentsRepository;
        $this->ticketsRepository  = $ticketRepository;
    }

    /**
     * Store a new support desk comment in the database.
     *
     * @param  CommentValidator $input      The user given input (validated).
     * @param  integer          $ticketId   The identifier form the ticket in the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentValidator $input, $ticketId): RedirectResponse
    {
        if (! $this->ticketsRepository->find($ticketId)) {
            flash("Wij konden geen support ticket vinden met de gegeven id.")->warning();
            return redirect()->back(302);
        }

        return redirect()->back(302);
    }
}
