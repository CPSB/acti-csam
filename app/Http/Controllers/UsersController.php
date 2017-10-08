<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Repositories\UsersRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
     * Get a user from the database and return them in json.
     *
     * @param  integer $userId The primary key for the user in the storage.
     * @return mixed
     */
    public function getUserJson($userId) // Geen typehints wegen mixed content return.
    {
        $user = $this->usersRepository->findOrFail($userId) ?: abort(404);
        return response()->json($user);
    }

    /**
     * Block the user in the system.
     *
     * @todo: Implemnet method that the currently authencated user cannot ban himself.
     * @todo: Implement method to send an email notification to the banned user.
     *
     * @param  Request $input The user given input.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block(Request $input): RedirectResponse
    {
        $validation = Validator::make($input->all(), [
           'userId' => 'required', 'reason' => 'required'
        ]);

        if ($validation->fails()) {
            flash("Wij kunnen de gebruiker niet blokkeren wegens validatie fouten.");
            return redirect()->back(302);
        }

        $user = $this->usersRepository->findOrFail($input->userId) ?: abort(404);
        $user->ban(['comment' => $input->reason, 'expired_at' => '+1 week']);

        flash("{$user->name} is geblokkeerd voor een week.")->success();

        return redirect()->route('users.index');
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
