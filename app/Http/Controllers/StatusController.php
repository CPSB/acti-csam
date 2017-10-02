<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Repositories\StatusRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class StatusController
 *
 * @package ActivismeBE\Http\Controllers
 */
class StatusController extends Controller
{
    private $statusRepository; /** @var StatusRepository $statusRepository */

    /**
     * StatusController constructor.
     *
     * @param  StatusRepository $statusRepository The abstraction layer for the statuses between controller and modal.
     * @return void
     */
    public function __construct(StatusRepository$statusRepository)
    {
        $this->middleware('author');
        // $this->middleware('role:admin');         // TODO: Build up and register middleware.
        // $this->middleware('forbid-banned-user'); // TODO: Build up and register middleware.

        $this->statusRepository = $statusRepository;
    }

    /**
     * The create view for a new status.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(): View
    {
        // TODO: Implement view.
    }

    /**
     * Store a new status in the system.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(): RedirectResponse
    {
        // TODO: Implement validator
        // TODO: Implement store logic.
    }

    /**
     * Delete a support ticket status out of the system.
     *
     * @param  integer $statusId The primary key from the status in the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($statusId): RedirectResponse
    {
        // TODO: Implementation delete logic.
        // TODO: Build up notification to notifify when user is not the deleter.
    }
}
