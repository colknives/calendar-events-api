<?php

namespace App\Services\CalendarEvent;

use Illuminate\Http\Request;
use App\Repositories\EventRepository;
use App\Services\CalendarEvent\AbstractCalendarEvent;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;

class GetEvents extends AbstractCalendarEvent
{
    protected $request;

    protected $repository;

    protected $month;

    protected $monthName;

    protected $year;

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
        
        $this->year = ( $this->request->get('year') )? $this->request->get('year') : Carbon::now()->format('Y');

        if( $this->request->get('month') ){
            $this->month = $this->request->get('month');
            $this->monthName = strtolower(Carbon::parse($this->year.'-'.$this->month.'-1')->format('F'));
        }
        else{
            $this->month = Carbon::now()->format('m');
            $this->monthName = strtolower(Carbon::now()->format('F'));
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
        $events = $this->repository->getEventlist($this->monthName, $this->year);

        $dates = [];
        $firstDay = Carbon::parse($this->year . '-0' . $this->month . '-01')->format('Y-m-d');
        $daysInMonth = Carbon::parse($firstDay)->daysInMonth;
        $lastDay = Carbon::parse($this->year . '-0' . $this->month . '-'.$daysInMonth)->format('Y-m-d');

        while( $firstDay <= $lastDay ){

            $date = Carbon::parse($firstDay);
            
            $dateRecord = [
                'date' => $firstDay,
                'day'  => $date->day,
                'day_of_week' => $date->shortEnglishDayOfWeek,
                'event_name' => ''
            ];

            if( $events ){

                $eventFrom = Carbon::parse($events->from);
                $eventTo = Carbon::parse($events->to);
                $specificDays = $events->specific_days;

                if( $eventFrom->lessThanOrEqualTo($date) && $eventTo->greaterThanOrEqualTo($date) ){
                    if( $specificDays && count($specificDays) > 0 ){
                        if( in_array(strtolower($date->englishDayOfWeek), $specificDays) ){
                            $dateRecord['event_name'] = $events->event_name;
                        }
                    }
                    else{
                        $dateRecord['event_name'] = $events->event_name;
                    }
                }
            }

            $dates[] = $dateRecord;
            $firstDay = $date->addDay()->format('Y-m-d');
        }

        $this->response = $this->makeResponse(200, 'list.200');
        $this->response->events = $dates;

        return $this;
    }
}
