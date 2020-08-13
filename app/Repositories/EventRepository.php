<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Event as Model;

class EventRepository {

    /**
     * EventRepository constructor
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Find event
     *
     * @param $field
     * @param $value
     * @return Model
     */
    public function find($field, $value) {
        return $this->model->where($field, $value)->first();
    }

    /**
     * Create event
     * 
     * @param array $data
     * @return Model 
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update event
     * 
     * @param Model $model
     * @param array $data
     * @return boolean
     */
    public function update(Model $model, array $data)
    {
        return $model->update($data);
    }

    /**
     * Get events list
     * 
     * @param string month
     * @return Model
     */
    public function getEventlist($month = null)
    {
        $query = $this->model;

        if( $month ){
            $month = Carbon::parse($month)->format('m');
            $query = $query->whereMonth('from', $month);
        }

        return $query->get();
    }
}
