<?php

namespace ActivismeBE\Http\Controllers;

use Gate;
use ActivismeBE\Http\Requests\StatusValidator;
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
    public function __construct(StatusRepository $statusRepository)
    {
        $this->middleware('author');
        $this->middleware('role:supervisor');
        $this->middleware('forbid-banned-user');

        $this->statusRepository = $statusRepository;
    }

    /**
     * The create view for a new status.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(): View
    {
        return view('statuses.create');
    }

    /**
     * Store a new status in the system.
     *
     * @todo register route.
     *
     * @param  StatusValidator $input The user given input (validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StatusValidator $input): RedirectResponse
    {
        $input->merge(['author_id' => auth()->user()->id]);

        if (Gate::allows('create')) {
            if ($status = $this->statusRepository->create($input->except('_token'))) {
                flash("De Status {$status->name} is opgeslagen in het systeem.")->success();
            }
        }

        return redirect()->back(302);
    }

    /**
     * Delete a support ticket status out of the system.
     *
     * @todo register route.
     *
     * @param  integer $statusId The primary key from the status in the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($statusId): RedirectResponse
    {
        $status = $this->statusRepository->find($statusId) ?: abort(404);

        // TODO: Register ACL gates
        if ($this->statusRepository->delete($statusId)) {
            flash("De status {$status->name} is verwijderd uit het systeem.")->success();
        }

        return redirect()->back(302);
    }
}
