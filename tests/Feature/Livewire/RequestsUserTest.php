<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\RequestsUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RequestsUserTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(RequestsUser::class);

        $component->assertStatus(200);
    }
}
