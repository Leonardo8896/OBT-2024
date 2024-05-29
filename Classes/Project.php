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

    public static function searchJSON(int $id): array
    {
        $data = json_decode(file_get_contents(DATA_BASE), true);

        return $data[$id];
    }

    public function save(): bool
    {
        $this->verifyName();
        $this->verifyDescription();
        $this->verifyPais();
        $this->verifyStatus();

        $newData = [
            'name' => $this->name,
            'description' => $this->description,
            'pais' => $this->pais,
            'status' => $this->status,
            'reparo' => $this->steps
        ];

        $existingData = [];
        $existis = false;
        $fileContent = file_get_contents(DATA_BASE);
        $existingData = json_decode($fileContent, true) ?: [];
        foreach ($existingData as $index => $project) {
            if ($project['name'] == $newData['name'] || $project['description'] == $newData['description']){
                $existingData[$index] = $newData;
                $existis = true;
            }
        }

        if (!$existis) {
            $existingData[] = $newData;
        }

        $result = file_put_contents(DATA_BASE, json_encode($existingData, JSON_PRETTY_PRINT));

        return $result !== false;
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

    private function verifyStatus(): void
    {
        foreach ($this->steps as $step) {
            if(!$step['check'] && $this->status == 'intacto') {
                throw new ProjectException('status', 'Um projeto com reparos a serem feitos não pode estar intacto');
            }
        }
    }
}