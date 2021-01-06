<?php

namespace App\Http\Controllers;

use App\Helpers\HelperPublic;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $responseCode = Response::HTTP_OK;
    protected $responseStatus = '';
    protected $responseMessage = '';
    protected $responseData = [];

    public function getResponse()
    {
        return HelperPublic::helpResponse($this->responseCode, $this->responseData, $this->responseMessage, $this->responseStatus);
    }
}
