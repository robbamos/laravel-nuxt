<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $statusCode = 200;

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function respondNoContent($message = 'No Results Found.')
    {
        return $this->setStatusCode(204)->respondWithError($message);
    }

    public function respondNotFound($message = 'Not Found.')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    public function respondDebug($data = [])
    {
        return $this->setStatusCode(404)->respond($data);
    }

    public function respondNotAuthorised($message = 'Not Authorised')
    {
        return $this->setStatusCode(401)->respondWithError($message);
    }

    public function respondValidationFailed($message = 'Invalid Submission')
    {
        return $this->setStatusCode(422)->respondWithError($message);
    }

    public function respondInternalError($message = 'Internal Server Error')
    {
        return $this->setStatusCode(500)->respondWithError($message);
    }

    public function respondSuccess($data = [])
    {
        return $this->setStatusCode(200)->respond($data);
    }

    public function respondUpdated($message = 'Successfully Updated')
    {
        return $this->setStatusCode(200)->respond(
            [
                'message' => $message,
            ]
        );
    }
    public function respondDeleted($message = 'Successfully Destroyed')
    {
        return $this->setStatusCode(200)->respond(
            [
                'message' => $message,
            ]
        );
    }

    public function respondCreated($message = 'Successfully Created')
    {
        return $this->setStatusCode(201)->respond(
            [
                'message' => $message,
            ]
        );
    }

    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message)
    {
        return $this->respond(
            [
                'error' => [
                    'message' => $message,
                    'status_code' => $this->getStatusCode(),
                ],

            ]
        );
    }
}
