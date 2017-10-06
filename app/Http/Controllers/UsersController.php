<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class UsersController
 *
 * @author
 * @package ActivismeBE\Http\Controllers
 */
class UsersController extends Controller
{
    private $usersRepository; /** @var UsersRepository $usersRepository */

    /**
     * UsersController constructor.
     *
     * @param UsersRepository $usersRepository Abstraction layer between database and controller.
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->middleware('auth');
        $this->middleware('role:admin|supervisor');
        $this->middleware('forbid-banned-user');

        $this->usersRepository = $usersRepository;
    }

    /**
     * Get the dashboard for the user management.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(): View
    {
        return view('users.index', [
            'users' => $this->usersRepository->entity()
        ]);
    }
}
