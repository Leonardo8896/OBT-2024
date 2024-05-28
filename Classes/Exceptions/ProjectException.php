<?php

namespace Obt\Iss\Exceptions;

class ProjectException extends \DomainException
{
    public readonly string $field;
    public function __construct(
        $field,
        $message
    )
    {
        $this->field = $field ?? '';
        parent::__construct($message);
    }

    public function getJSON(): string
    {
        $data = [
            'field' => $this->field,
            'message' => $this->message
        ];
        return json_encode($data);
    }
}