<?php

namespace App\Services\CalendarEvent;

use Illuminate\Http\Request;
use App\Services\AbstractBaseService;
use App\Repositories\EventRepository;

class CalendarEventService extends AbstractBaseService implements CalendarEventInterface {

    protected $eventRepository;

    /**
     * CalendarEventService constructor
     *
     * @param Request $request
     * @param EventRepository $eventRepository
     */
    public function __construct(
        Request $request,
        EventRepository $eventRepository)
    {
        $this->request = $request;
        $this->eventRepository = $eventRepository;

        parent::__construct($request);
    }

    /**
     * Create Event Service
     *
     * @return object
     */
    public function createEvent()
    {
        return (new CreateEvent($this->request, $this->eventRepository))->handle()->response;
    }

    /**
     * Get Events Service
     *
     * @return object
     */
    public function getEvents()
    {
        return (new GetEvents($this->request, $this->eventRepository))->handle()->response;
    }
}
