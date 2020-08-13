<?php

namespace App\Services;

use Illuminate\Http\Request;

abstract class AbstractBaseService {

    protected $request;

    protected $module = 'base';

    protected $response = null;

    /**
     * AbstractBaseService constructor
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Return response instance
     *
     * @return object
     */
    public function response()
    {
        return $this->response;
    }

    /**
     * Create response object
     *
     * @param int $status
     * @param string $message
     * @param array $data
     * @return object
     */
    protected function makeResponse(int $status, string $message, array $data = [])
    {
        return (object) [
            "status" => $status,
            "message" => __("messages.{$this->module}.{$message}", $data)
        ];
    }
}
