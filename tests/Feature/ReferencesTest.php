<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReferencesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_reference()
    {
        $this->withoutExceptionHandling();

        $attributes = factory('App\Reference')->raw();
        $user = \App\User::find($attributes['owner_id']);

        $response = $this->actingAs($user)->post('/references', $attributes);
        $response->assertRedirect('/references');

        $this->assertDatabaseHas('references', $attributes);
        
        $response = $this->get('/references');
        $response->assertStatus(200);
    }

    /**
     * If you are not registered in the system, you can't create new references
     *
     * @test
     */
    public function only_authenticated_users_can_create_references()
    {
        //$this->withoutExceptionHandling();
        $attributes = factory('App\Reference')->raw();
        $this->post('/references', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_view_a_reference()
    {
        $this->withoutExceptionHandling();
        $reference = factory('App\Reference')->create();

        $this->get($reference->path())
            ->assertSee($reference->term)
            ->assertSee($reference->type);
    }

    /** @test */
    public function reference_term_validation()
    {
        // The term is required
        $attributes = factory('App\Reference')->raw(['term' => '']);
        $user = \App\User::find($attributes['owner_id']);
        $this->actingAs($user)->post('/references', $attributes)->assertSessionHasErrors('term');
    }

    /** @test */
    public function reference_slug_validation()
    {
        // The slug is required
        $attributes = factory('App\Reference')->raw(['slug' => '']);
        $user = \App\User::find($attributes['owner_id']);
        $this->actingAs($user)->post('/references', $attributes)->assertSessionHasErrors('slug');
    }

    /** @test */
    public function reference_type_validation()
    {
        // The type is required
        $attributes = factory('App\Reference')->raw(['type' => '']);
        $user = \App\User::find($attributes['owner_id']);
        $this->actingAs($user)->post('/references', $attributes)->assertSessionHasErrors('type');

        // The type's right values are: ID, PV, SL, SY
        $attributes = factory('App\Reference')->raw(['type' => 'RD']);
        $user = \App\User::find($attributes['owner_id']);
        $this->actingAs($user)->post('/references', $attributes)->assertSessionHasErrors('type');
    }
}
