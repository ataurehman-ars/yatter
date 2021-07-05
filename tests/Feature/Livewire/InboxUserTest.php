<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\InboxUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class InboxUserTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(InboxUser::class);

        $component->assertStatus(200);
    }
}
