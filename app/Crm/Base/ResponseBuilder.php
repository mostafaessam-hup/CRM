<?php

namespace Crm\Base;

use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseBuilder
{
    private int $statusCode = 200;
    private $data = null;
    private array $errors = [];
    private string $status = 'success';
    private array $meta = [];

    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';


    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setErrors($errors): self
    {
        $this->errors = $errors;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getMeta()
    {
        return $this->meta;
    }


    public function setMeta($meta): self
    {
        $this->meta = $meta;

        return $this;
    }

    public function response()
    {
        $response = [];
        $response['status'] = $this->getStatus();
        
        if ($this->getStatus() !== JsonResponse::HTTP_OK && !empty($this->getErrors())) {
            $response['errors'] = $this->getErrors();
        }

        if ($this->getStatus() === self::STATUS_SUCCESS) {
            $response['data'] = $this->getData();
        }

        return response()->json($response, $this->getStatusCode());
    }
}
