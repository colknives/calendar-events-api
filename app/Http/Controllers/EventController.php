<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Event controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

        dd('hey');

        // $event = $this->eventService->create();

    }
}
