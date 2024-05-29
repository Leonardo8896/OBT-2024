<?php

namespace Obt\Iss;

class SearchProject
{
    public function searchById(int $id): array
    {
        $data = json_decode(file_get_contents(DATA_BASE), true);

        return $data[0];
    }
}