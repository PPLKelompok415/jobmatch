<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChatTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/chat')
                ->type('chatInput', 'Hai')
                ->press('Send')
                ->pause(1000) 
                ->assertSee('Hai')
                ->assertSee('Thank you for your message');
        });
    }
}
