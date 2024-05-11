<?php

namespace App\Repositories;

use App\Models\Crud;
use App\Repositories\BaseRepository;

class CrudRepository extends BaseRepository
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
        return Crud::class;
    }
}
