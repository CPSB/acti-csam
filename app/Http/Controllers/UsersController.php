<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Repositories\UsersRepository;
use Illuminate\Http\RedirectResponse;
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

    /**
     * Delete a user out off the system.
     *
     * @param  integer $userId The primary key from the user in the storage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($userId): RedirectResponse
    {
        $user = $this->usersRepository->find($userId) ?: abort(404);

        if ($user->isBanned()) { // The user is currently banned in the system.
            $user->unban(); // Unban in theuser in the system before the deletion.
        }

        if ($this->usersRepository->delete($userId)) {
            flash("{$user->name} is verwijderd uit het systeem.")->success();
        }

        return redirect()->route('users.index');
    }
}
