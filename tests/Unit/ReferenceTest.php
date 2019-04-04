<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Reference;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReferenceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $reference = factory('App\Reference')->create();

        $this->assertEquals('/references/'. $reference->id, $reference->path());
    }
}
