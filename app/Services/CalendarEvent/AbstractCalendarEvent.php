<?php

namespace App\Services\CalendarEvent;

use App\Services\AbstractBaseService;
use Illuminate\Http\Request;

abstract class AbstractCalendarEvent extends AbstractBaseService
{
    protected $module = 'event';

    /**
     * AbstractCalendarEvent constructor
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    abstract public function handle(): AbstractCalendarEvent;
}
