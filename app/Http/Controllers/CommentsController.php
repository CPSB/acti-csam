<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Repositories\CommentsRepository;
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
    }
}
