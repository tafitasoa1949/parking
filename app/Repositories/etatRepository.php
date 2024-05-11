<?php

namespace App\Repositories;

use App\Models\etat;
use App\Repositories\BaseRepository;

class etatRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'code',
        'couleur'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return etat::class;
    }
}
