<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\{AccountInfoValidator, AccountSecurityValidator};
use ActivismeBE\Repositories\UsersRepository;
use Illuminate\Http\{Response, RedirectResponse};
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

/**
 * Class AccountSettingsController
 *
 * @author  Tim Joosten
 * @license MIT LICENSE
 * @package ActivismeBE\Http\Controllers
 */
class AccountSettingsController extends Controller
{
    // TODO: Write tests for the AccountSettingsController

    private $user;            /** @var Auth            $user            */
    private $usersRepository; /** @var UsersRepository $usersRepository */

    /**
     * AccountSettingsController constructor.
     *
     * @param  UsersRepository $usersRepository The users abstraction layer between database and controller.
     * @return void
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->middleware('auth');
        // $this->middleware('role:admin')              // TODO: Build up and register the middleware.
        // $this->middleware('forbid-banned-user');     // TODO: Build up and register the middleware.

        $this->user            = auth()->user();        // The attribute for the currently authenticated user.
        $this->usersRepository = $usersRepository;
    }

    /**
     * Get the configuration dashboard for the account.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(): View
    {
        return view('account-settings.index');
    }

    /**
     * Update the user his account security settings.
     *
     * @param  AccountSecurityValidator $input The user given input (validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSecurity(AccountSecurityValidator $input): RedirectResponse
    {
        $data = ['password' => bcrypt($input->password)];

        if ($this->usersRepository->update($data, $this->user->id)) {
            flash("Jouw account beveiliging is aangepast.")->success();
        }

        return redirect()->back(Response::HTTP_FOUND);
    }

    /**
     * Update the user his information.
     *
     * @param  AccountInfoValidator $input The user given input (validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateInfo(AccountInfoValidator $input): RedirectResponse
    {
        if ($input->hasFile('userImage')) {
            $avatar = public_path(auth()->user()->avatar);

            if (file_exists($avatar) && auth()->user()->avatar != 'avatars/default.jpg') {
                unlink($avatar);
            }

            $image      = $input->file('userImage');
            $filename   = time() . '.' . $image->getClientOriginalExtension();
            $path       = public_path("avatars/{$filename}");


            Image::make($image->getRealPath())->resize(160, 160)->save($path);
            $input->merge(['avatar' => "avatars/{$filename}"]);
        }

        if ($this->usersRepository->update($input->except(['_token', 'userImage']), auth()->user()->id)) {
            flash("Jouw account informatie is aangepast.")->success();
        }

        return redirect()->back(Response::HTTP_FOUND);
    }
}
