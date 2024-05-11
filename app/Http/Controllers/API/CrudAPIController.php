<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCrudAPIRequest;
use App\Http\Requests\API\UpdateCrudAPIRequest;
use App\Models\Crud;
use App\Repositories\CrudRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CrudAPIController
 */
class CrudAPIController extends AppBaseController
{
    private CrudRepository $crudRepository;

    public function __construct(CrudRepository $crudRepo)
    {
        $this->crudRepository = $crudRepo;
    }

    /**
     * Display a listing of the Cruds.
     * GET|HEAD /cruds
     */
    public function index(Request $request): JsonResponse
    {
        $cruds = $this->crudRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($cruds->toArray(), 'Cruds retrieved successfully');
    }

    /**
     * Store a newly created Crud in storage.
     * POST /cruds
     */
    public function store(CreateCrudAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $crud = $this->crudRepository->create($input);

        return $this->sendResponse($crud->toArray(), 'Crud saved successfully');
    }

    /**
     * Display the specified Crud.
     * GET|HEAD /cruds/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Crud $crud */
        $crud = $this->crudRepository->find($id);

        if (empty($crud)) {
            return $this->sendError('Crud not found');
        }

        return $this->sendResponse($crud->toArray(), 'Crud retrieved successfully');
    }

    /**
     * Update the specified Crud in storage.
     * PUT/PATCH /cruds/{id}
     */
    public function update($id, UpdateCrudAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Crud $crud */
        $crud = $this->crudRepository->find($id);

        if (empty($crud)) {
            return $this->sendError('Crud not found');
        }

        $crud = $this->crudRepository->update($input, $id);

        return $this->sendResponse($crud->toArray(), 'Crud updated successfully');
    }

    /**
     * Remove the specified Crud from storage.
     * DELETE /cruds/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Crud $crud */
        $crud = $this->crudRepository->find($id);

        if (empty($crud)) {
            return $this->sendError('Crud not found');
        }

        $crud->delete();

        return $this->sendSuccess('Crud deleted successfully');
    }
}
