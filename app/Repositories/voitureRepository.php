<?php

namespace App\Repositories;

use App\Models\voiture;
use App\Repositories\BaseRepository;

class voitureRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'marque_id',
        'longueur'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return voiture::class;
    }
}
