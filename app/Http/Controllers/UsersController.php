<?php

namespace ActivismeBE\Http\Controllers;

use Gate;
use ActivismeBE\Http\Requests\UsersValidator;
use ActivismeBE\Mail\NewUser;
use ActivismeBE\Mail\UserBlocked;
use ActivismeBE\Repositories\{UsersRepository, RoleRepository};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

/**
 * Class UsersController
 *
 * @author  Tim Joosten 
 * @license MIT License
 * @package ActivismeBE\Http\Controllers
 */
class UsersController extends Controller
{
    private $roleRepository;  /** @var UsersRepository $roleRepository  */
    private $usersRepository; /** @var UsersRepository $usersRepository */

    /**
     * UsersController constructor.
     *
     * @todo: LOW:      Refactor the USE statements.
     * @todo: MEDIUM:   Build up nd register the session repository, model. 
     * @todo: LOW:      Translate the flash messages for the controller. 
     * 
     * @param  UsersRepository $usersRepository Abstraction layer between database and controller.
     * @param  RoleRepository  $roleRepository  Abstraction layer between database and controller.
     * @return void
     */
    public function __construct(
        UsersRepository $usersRepository, RoleRepository $roleRepository
    ) {
        $this->middleware('auth');
        $this->middleware('role:supervisor')->except('destroy');
        $this->middleware('forbid-banned-user');

        $this->usersRepository = $usersRepository;
        $this->roleRepository  = $roleRepository;
    }

    /**
     * Get the dashboard for the user management.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(): View
    {
        //! TODO: Need confirmation box. To confirm that user wants to delete his account. 
        //!       Should only be applie to the account settings interface

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

        if (auth()->user()->id == $input->userId) {
            flash("U kunt uzelf niet blokkeren in het systeem.")->error();
            return redirect()->back(302);
        }

        $user = $this->usersRepository->findOrFail($input->userId) ?: abort(404);
        $user->ban(['comment' => $input->reason, 'expired_at' => '+1 week']);

        flash("{$user->name} is geblokkeerd voor een week.")->success();
        Mail::to($user->email)->send(new UserBlocked($user, $input));

        return redirect()->route('users.index');
    }

    /**
     * Create view for a new view in the user.
     *
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function create(): View
    {
        return view('users.create', [
            'roles' => $this->roleRepository->all(['id' => 'name'])
        ]);
    }

    /**
     * Store the new user in the database storage.
     *
     * @param  UsersValidator $input The user given input. (validated)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UsersValidator $input): RedirectResponse
    {
        $password = str_random(15);
        $input->merge(['password' => bcrypt($password)]);

        if ($user = $this->usersRepository->create($input->except('_token'))) {
            // dd($input->all()); // Debugging propose.
            Mail::to($input->email)->send(new NewUser($input, $password));
            flash("{$user->name} is geregistreerd in het systeem.")->success();
        }

        return redirect()->route('users.index');
    }

    /**
     * Unblock a user in the system.
     *
     * @param  integer $userId The primary key for the user in the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unblock($userId): RedirectResponse
    {
        $user = $this->usersRepository->findOrFail($userId) ?: abort(404);

        if ($user->id != auth()->user()->id && $user->isBanned()) { // The authencated user can't unblock himself.
            $user->unban();
            flash("{$user->name} is terug geactiveerd in het systeem.")->success();
        }

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

        if (Gate::allows('delete', $user)) {                // Check if the user has the right permissions.
            // TODO: Need to check if the if statemenr is needed.
            if ($user->isBanned()) {                        // The user is currently banned in the system.
                $user->unban();                             // Unban in the user in the system before the deletion.
            }

            if ($this->usersRepository->delete($userId)) {  // User deleted
                if ($user->is == auth()->user()->id) { // TODO: Refactor to session repository. That communicates with the db table.
                    auth()->logout();
                }

                flash("{$user->name} is verwijderd uit het systeem.")->success();
            }
        }

        return redirect()->route('users.index');
    }
}