<?php

namespace ActivismeBE\Http\Controllers;

use Gate;
use ActivismeBE\Http\Requests\CommentValidator;
use ActivismeBE\Repositories\{SupportDeskRepository, CommentsRepository};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class CommentsController
 *
 * @author  Tim Joosten
 * @license MIT LICENSE
 * @package ActivismeBE\Http\Controllers
 */
class CommentsController extends Controller
{
    // TODO: register translations for the controller.

    private $commentsRepository; /** @var CommentsRepository    $commentsRepository */
    private $ticketRepository;   /** @var SupportDeskRepository $ticketRepository   */

    /**
     * CommentsController constructor.
     *
     * @param  CommentsRepository       $commentsRepository The abstraction layer between controller and ORM.
     * @param  SupportDeskRepository    $ticketRepository   The abstraction layer between controller and ORM.
     *
     * @return void
     */
    public function __construct(CommentsRepository $commentsRepository, SupportDeskRepository $ticketRepository)
    {
        $this->middleware('auth');
        // $this->middleware('role:admin')->except(['destroy']);
        // this->middleware('forbid-banned-user'); // TODO: Build up the register middleware.

        $this->commentsRepository = $commentsRepository;
        $this->ticketRepository   = $ticketRepository;
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
        $ticket = $this->ticketRepository->find($ticketId) ?: abort(Response::HTTP_NOT_FOUND);

        if (Gate::allows('store', $ticket)) { // The user is authorized for performing the action.
            $input->merge(['author_id' => auth()->user()->id]);

            if ($comment = $this->commentsRepository->create($input->except('_token'))) {
                $ticket->comments()->attach($comment->id);

                flash("Uw reactie is toegevoegd aan het ticket.")->success();
                return redirect()->back(302);
            }
        }

        flash("U hebt geen machteging om het ticket te bekijken.")->error();
        return redirect()->back(302);
    }

    /**
     * Delete a comment from the system.
     *
     * @param  integer $commentId The unique identifier in the sorage for the comment.
     * @return RedirectResponse
     */
    public function destroy($commentId): RedirectResponse
    {
        $comment = $this->commentsRepository->find($commentId) ?: abort(Response::HTTP_NOT_FOUND);

        if (Gate::allows('delete', $comment)) { // user is authorized to delete the comment.
            $comment->tickets()->sync([]);

            if ($comment->delete()) { // The comment record has been deleted.
                flash("De reactie is verwijderd uit het systeem.")->success();
                return redirect()->back(302);
            }
        }

        flash("U hebt geen rechten om de reactie te verwijderen.")->success();
        return redirect()->back(302);
    }
}
