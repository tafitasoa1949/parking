<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemarqueAPIRequest;
use App\Http\Requests\API\UpdatemarqueAPIRequest;
use App\Models\marque;
use App\Repositories\marqueRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class marqueAPIController
 */
class marqueAPIController extends AppBaseController
{
    private marqueRepository $marqueRepository;

    public function __construct(marqueRepository $marqueRepo)
    {
        $this->marqueRepository = $marqueRepo;
    }

    /**
     * Display a listing of the marques.
     * GET|HEAD /marques
     */
    public function index(Request $request): JsonResponse
    {
        $marques = $this->marqueRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($marques->toArray(), 'Marques retrieved successfully');
    }

    /**
     * Store a newly created marque in storage.
     * POST /marques
     */
    public function store(CreatemarqueAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $marque = $this->marqueRepository->create($input);

        return $this->sendResponse($marque->toArray(), 'Marque saved successfully');
    }

    /**
     * Display the specified marque.
     * GET|HEAD /marques/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var marque $marque */
        $marque = $this->marqueRepository->find($id);

        if (empty($marque)) {
            return $this->sendError('Marque not found');
        }

        return $this->sendResponse($marque->toArray(), 'Marque retrieved successfully');
    }

    /**
     * Update the specified marque in storage.
     * PUT/PATCH /marques/{id}
     */
    public function update($id, UpdatemarqueAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var marque $marque */
        $marque = $this->marqueRepository->find($id);

        if (empty($marque)) {
            return $this->sendError('Marque not found');
        }

        $marque = $this->marqueRepository->update($input, $id);

        return $this->sendResponse($marque->toArray(), 'marque updated successfully');
    }

    /**
     * Remove the specified marque from storage.
     * DELETE /marques/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var marque $marque */
        $marque = $this->marqueRepository->find($id);

        if (empty($marque)) {
            return $this->sendError('Marque not found');
        }

        $marque->delete();

        return $this->sendSuccess('Marque deleted successfully');
    }
}
