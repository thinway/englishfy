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
        $attributes = [
            'term' => 'In hot water',
            'slug' => 'in-hot-water',
            'type' => 'ID'
        ];

        $response = $this->post('/references', $attributes);
        $response->assertRedirect('/references');

        $this->assertDatabaseHas('references', $attributes);
        
        $response = $this->get('/references');
        $response->assertStatus(200);
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
        $this->post('/references', $attributes)->assertSessionHasErrors('term');
    }

    /** @test */
    public function reference_slug_validation()
    {
        // The slug is required
        $attributes = factory('App\Reference')->raw(['slug' => '']);

        $this->post('/references', $attributes)->assertSessionHasErrors('slug');
    }

    /** @test */
    public function reference_type_validation()
    {
        // The type is required
        $attributes = factory('App\Reference')->raw(['type' => '']);
        $this->post('/references', $attributes)->assertSessionHasErrors('type');

        // The type's right values are: ID, PV, SL, SY
        $attributes = factory('App\Reference')->raw(['type' => 'RD']);
        $this->post('/references', $attributes)->assertSessionHasErrors('type');
    }
}
