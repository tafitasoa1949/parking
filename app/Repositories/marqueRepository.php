<?php

namespace App\Repositories;

use App\Models\marque;
use App\Repositories\BaseRepository;

class marqueRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nom'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return marque::class;
    }
}
