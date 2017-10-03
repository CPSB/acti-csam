<?php

namespace ActivismeBE\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class CommentsController
 *
 * @package ActivismeBE\Http\Controllers
 */
class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
