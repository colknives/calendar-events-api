<?php

use App\Models\Event;

class EventTest extends TestCase
{
    /**
     * @test Should be able to save event
     *
     * @return void
     */
    public function testShouldBeAbleToSaveEvent()
    {
        $event = factory(Event::class)->make();
        
        $response = $this->post('event/save', [
            'event_name' => $event->event_name,
            'from' => $event->from,
            'to' => $event->to,
            'specific_days' => $event->specific_days,
            'color' => $event->color
        ]);
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message',
            'event'
        ]);
    }

    /**
     * @test Should be able to retrieve events in a given month
     *
     * @return void
     */
    public function testShouldBeAbleToRetrieveEvent()
    {
        $event = factory(Event::class, 5)->create();
        
        $response = $this->get('event/list?month=august');
        $response->assertResponseStatus(200);
        $response->seeJsonStructure([
            'message',
            'events'
        ]);
    }
}
