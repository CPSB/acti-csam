<?php

namespace ActivismeBE\Http\Controllers;

use ActivismeBE\Http\Requests\CategoryValidator;
use ActivismeBE\Notifications\CategoryCreated;
use ActivismeBE\Repositories\CategoryRepository;
use ActivismeBE\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class CategoryController
 *
 * @author  Tim Joosten
 * @license MIT LICENSE
 * @package ActivismeBE\Http\Controllers
 */
class CategoryController extends Controller
{
    private $categoryRepository; /** @var CategoryRepository $categoryRepository */

    /**
     * CategoryController constructor.
     *
     * @param  CategoryRepository $categoryRepository Abstraction layer between database and model.
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->middleware('auth');
        $this->middleware('role:supervisor');
        $this->middleware('forbid-banned-user');

        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Create view for a new support desk category.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Create a new category for the tickets in the system.
     *
     * @param  CategoryValidator $input The user given input (validated).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryValidator $input): RedirectResponse
    {
        $input->merge(['author_id' => auth()->user()->id, 'module' => 'support-desk']);

        if ($category = $this->categoryRepository->create($input->except('_token'))) {
            $users = User::role('supervisor')->get();

            foreach ($users as $user) { // Loop through the supervisors
                $user->notify(new CategoryCreated(auth()->user()));
            }

            flash("'{$category->name}' is toegevoegd als support categorie.")->success();
        }

        return redirect()->route('category.create');
    }

    /**
     * Edit a category in the system.
     *
     * @param  integer $categoryId The unique identifier in the database for the category
     * @return \Illuminate\Contracts\View\Factory|View
     */
    public function edit($categoryId)
    {
        $category = $this->categoryRepository->findOrFail($categoryId) ?: abort(404);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the category in the database.
     *
     * @param  CategoryValidator    $input
     * @param  integer              $categoryId
     * @return RedirectResponse
     */
    public function update(CategoryValidator $input, $categoryId): RedirectResponse
    {
        $cat = $this->categoryRepository->findOrFail($categoryId) ?: abort(404);

        if ($category = $this->categoryRepository->update($input->except('_token'), $cat->id)) {
            flash("{$cat->name} is met success aangepast in het systeem.")->success();
        }

        return redirect()->route('support.index');
    }

    /**
     * Delete a category ot off the system.
     *
     * @param  integer $categoryId The primary key for the category in the storage.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($categoryId)
    {
        $cat = $this->categoryRepository->find($categoryId) ?: abort(404);

        if ($this->categoryRepository->delete($categoryId)) {
            flash("{$cat->name} is verwijderd als categorie uit het systeem.")->success();
        }

        return redirect()->back(302);
    }
}
