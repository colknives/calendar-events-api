<?php

namespace App\Services\CalendarEvent;

use Illuminate\Http\Request;
use App\Repositories\EventRepository;
use App\Services\CalendarEvent\AbstractCalendarEvent;
use Ramsey\Uuid\Uuid;

class CreateEvent extends AbstractCalendarEvent
{
    protected $request;

    protected $repository;

    /**
     * CreateEvent constructor
     *
     * @param Request $request
     * @param EventRepository $repository
     *
     */
    public function __construct(
        Request $request,
        EventRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;

        parent::__construct($request);
    }

    /**
     * Create event handle
     *
     * @return AbstractCalendarEvent
     */
    public function handle(): AbstractCalendarEvent
    {
        $data = [
            'uuid' => Uuid::uuid4()->toString(),
            'event_name' => $this->request->post('event_name'),
            'from' => $this->request->post('from'),
            'to' => $this->request->post('to'),
            'specific_days' => $this->request->post('specific_days'),
            'color' => $this->request->post('color')
        ];

        $create = $this->repository->create($data);

        if( !$create ){
            $this->response = $this->makeResponse(400, 'save.400');
            $this->response->event = null;
            return $this;
        }

        $this->response = $this->makeResponse(200, 'save.200');
        $this->response->event = $create;

        return $this;
    }
}
