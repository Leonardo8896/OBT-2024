<?php

namespace Obt\Iss;
use Obt\Iss\Exceptions\ProjectException;

class Project
{
    public function __construct(
        private string $name,
        private string $description,
        private string $pais,
        private string $status,
        private array $steps = []
    ){}

    public function save(): bool
    {
        $this->verifyName();
        $this->verifyDescription();
        $this->verifyPais();

        $json  = [
            'name' => $this->name,
            'description' => $this->description,
            'pais' => $this->pais,
            'status' => $this->status,
            'reparo' => json_encode($this->steps)
        ];
        $result = file_put_contents(DATA_BASE, json_encode($json));

        return $result;
    }

    private function verifyName(): void
    {
        if($this->name == '') {
            throw new ProjectException('name', 'O campo nome deve ser preenchido!');
        }
    }

    private function verifyDescription(): void
    {
        if($this->description == '') {
            throw new ProjectException('description', 'A descrição deve ser preenchida');
        }
    }

    private function verifyPais(): void
    {
        if($this->pais == '') {
            throw new ProjectException('country', 'Selecione um país');
        }
    }
}