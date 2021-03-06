<?php

namespace Tests\Feature\Livewire\Game;

use App\Http\Livewire\Game\MessageList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MessageListTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(MessageList::class);

        $component->assertStatus(200);
    }
}
