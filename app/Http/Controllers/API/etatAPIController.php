<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateetatAPIRequest;
use App\Http\Requests\API\UpdateetatAPIRequest;
use App\Models\etat;
use App\Repositories\etatRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class etatAPIController
 */
class etatAPIController extends AppBaseController
{
    private etatRepository $etatRepository;

    public function __construct(etatRepository $etatRepo)
    {
        $this->etatRepository = $etatRepo;
    }

    /**
     * Display a listing of the etats.
     * GET|HEAD /etats
     */
    public function index(Request $request): JsonResponse
    {
        $etats = $this->etatRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($etats->toArray(), 'Etats retrieved successfully');
    }

    /**
     * Store a newly created etat in storage.
     * POST /etats
     */
    public function store(CreateetatAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $etat = $this->etatRepository->create($input);

        return $this->sendResponse($etat->toArray(), 'Etat saved successfully');
    }

    /**
     * Display the specified etat.
     * GET|HEAD /etats/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var etat $etat */
        $etat = $this->etatRepository->find($id);

        if (empty($etat)) {
            return $this->sendError('Etat not found');
        }

        return $this->sendResponse($etat->toArray(), 'Etat retrieved successfully');
    }

    /**
     * Update the specified etat in storage.
     * PUT/PATCH /etats/{id}
     */
    public function update($id, UpdateetatAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var etat $etat */
        $etat = $this->etatRepository->find($id);

        if (empty($etat)) {
            return $this->sendError('Etat not found');
        }

        $etat = $this->etatRepository->update($input, $id);

        return $this->sendResponse($etat->toArray(), 'etat updated successfully');
    }

    /**
     * Remove the specified etat from storage.
     * DELETE /etats/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var etat $etat */
        $etat = $this->etatRepository->find($id);

        if (empty($etat)) {
            return $this->sendError('Etat not found');
        }

        $etat->delete();

        return $this->sendSuccess('Etat deleted successfully');
    }
}
