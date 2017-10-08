<?php

namespace ActivismeBE\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/**
 * Class AuthServiceProvider
 *
 * @package ActivismeBE\Providers
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \ActivismeBE\SupportDesk::class => \ActivismeBE\Policies\SupportDeskPolicy::class,
        \ActivismeBE\Comments::class    => \ActivismeBE\Policies\CommentPolicy::class,
        \ActivismeBE\User::class        => \ActivismeBE\Policies\UserPolicy::class,
        \ActivismeBE\Statusses::class   => \ActivismeBE\Policies\StatusPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
