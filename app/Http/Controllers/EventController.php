<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CalendarEvent\CalendarEventInterface as CalendarEventService;
use App\Http\Resources\Collection\EventCollection;
use App\Http\Resources\Event as EventResource;

class EventController extends AbstractBaseController
{

    protected $eventService;

    /**
     * Event controller instance.
     *
     * @return void
     */
    public function __construct(CalendarEventService $eventService)
    {
        $this->eventService = $eventService;
    }

    /**
     * Create event method
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function save(Request $request)
    {
        $this->validate($request, [
            'event_name' => 'required',
            'from' => 'required',
            'to' => 'required'
        ]);

        $create = $this->eventService->createEvent();

        //Prepare resource
        $details = ( $create->event )? new EventResource($create->event) : null;

        return response()->json([
            "message" => $create->message,
            "event" => $details
        ], $create->status);
    }

    /**
     * Get event list method
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request)
    {
        $this->validate($request, [
            'month' => 'valid_month'
        ],
        [
            'month.valid_month' => 'Month is invalid'
        ]);

        $event = $this->eventService->getEvents();

        //Prepare collection
        $collection = $this->prepareCollection(new EventCollection($event->list));

        return response()->json([
            "message" => $event->message,
            "events" => $collection['data']
        ], $event->status);
    }
}
