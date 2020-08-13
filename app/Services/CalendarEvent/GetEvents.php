<?php

namespace App\Services\CalendarEvent;

use Illuminate\Http\Request;
use App\Repositories\EventRepository;
use App\Services\CalendarEvent\AbstractCalendarEvent;
use Ramsey\Uuid\Uuid;

class GetEvents extends AbstractCalendarEvent
{
    protected $request;

    protected $repository;

    protected $month;

    /**
     * GetEvents constructor
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

        if( $this->request->get('month') ){
            $this->month = $this->request->get('month');
        }

        parent::__construct($request);
    }

    /**
     * Get event handle
     *
     * @return AbstractCalendarEvent
     */
    public function handle(): AbstractCalendarEvent
    {
        //Get event list
        $users = $this->repository->getEventlist($this->month);

        $this->response = $this->makeResponse(200, 'list.200');
        $this->response->list = $users;

        return $this;
    }
}
