<?php

namespace Tests\Feature;

use ActivismeBE\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class AccountSettingsTest
 *
 * @package Tests\Feature
 */
class AccountSettingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @covers \ActivismeBE\Http\Controllers\AccountSettingsController::index()
     */
    public function testSettingsIndexUnauthorized()
    {
        $this->get(route('account.settings'))
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @covers \ActivismeBE\Http\Controllers\AccountSettingsController::index()
     */
    public function testSettingsIndexAuthorized()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->get(route('account.settings'))
            ->assertStatus(200);
    }

    /**
     * @test
     * @covers \ActivismeBE\Http\Controllers\AccountSettingsController::index()
     */
    public function testUpdateSecurityUnauthorized()
    {
        $input = ['password' => 'testtest', 'password_confirmation' => 'testtest'];

        $this->post(route('account.settings.security'), $input)
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     * @covers \ActivismeBE\Http\Controllers\AccountSettingsController::updateSecurity()
     */
    public function testUpdateSecurityAuthorizedOk()
    {

        $user  = factory(User::class)->create();
        $input = ['password' => 'testtest', 'password_confirmation' => 'testtest'];

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->post(route('account.settings.security'), $input)
            ->assertStatus(302)
            ->assertSessionHas([
                'flash_notification.0.message' => 'Jouw account beveiliging is aangepast.',
                'flash_notification.0.level'   => 'success'
            ]);
    }

    /**
     * @test
     * @covers \ActivismeBE\Http\Controllers\AccountSettingsController::updateSecurity()
     */
    public function testUpdateSecurityValidationErrors()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->assertAuthenticatedAs($user)
            ->post(route('account.settings.security'), [])
            ->assertStatus(302)
            ->assertSessionHasErrors();
    }
}
