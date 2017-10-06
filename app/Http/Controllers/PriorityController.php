<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\PriorityValidator;
use ActivismeBE\Notifications\PriorityCreated;
use ActivismeBE\Repositories\PriorityRepository;
use ActivismeBE\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class PriorityController
 *
 * @author  Tim Joosten
 * @license MIT License
 * @package ActivismeBE\Http\Controllers
 */
class PriorityController extends Controller
{
    private $priorityRepository; /** @var PriorityRepository $priorityController */

    /**
     * PriorityController constructor.
     *
     * @param  PriorityRepository $priorityRepository Abstraction layer between database and controller.
     * @return void
     */
    public function __construct(PriorityRepository $priorityRepository)
    {
        $this->middleware('auth');
        $this->middleware('role:supervisor');
        $this->middleware('forbid-banned-user');

        $this->priorityRepository = $priorityRepository;
    }

    /**
     * Create view for the priority management.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(): View
    {
        return view('priorities.create');
    }

    /**
     * Store the new priority label in the database.
     *
     * @param  PriorityValidator $input The user given input (validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PriorityValidator $input): RedirectResponse
    {
        $input->merge(['author_id' => auth()->user()->id]);

        if ($priority = $this->priorityRepository->create($input->except('_token'))) {
            $supervisors = User::role('supervisor')->get();

            foreach ($supervisors as $supervisor) { // Loop through the supervisors to notify them.
                $supervisor->notify(new PriorityCreated(auth()->user()));
            }

            flash("'{$priority->name}' is als prioriteit toegevoegd in het systeem.");
        }

        return redirect()->route('support.index');
    }

    /**
     * Edit view for the priority label.
     *
     * @param  integer $priorityId The primary key from the priority in the storage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($priorityId): View
    {
        $priority = $this->priorityRepository->find($priorityId) ?: abort(404);
        return view('priorities.edit', compact('priority'));
    }

    /**
     * Update a priority label in the database system.
     *
     * @param  PriorityValidator $input         The user given input (validated).
     * @param  integer           $priorityId    The priority primary key in the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PriorityValidator $input, $priorityId): RedirectResponse
    {
        //
    }

    /**
     * Delete a priority label in the database.
     *
     * @param  integer $priorityId  The primary key  from the priority in the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($priorityId): RedirectResponse
    {
        $priority = $this->priorityRepository->find($priorityId) ?: abort(404);

        if ($this->priorityRepository->delete($priorityId)) {
            flash("De prioriteit '{$priority->name}' is verwijderd uit het systeem.")->success();
        }

        return redirect()->back(302);
    }
}
