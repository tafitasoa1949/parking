<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatevoitureAPIRequest;
use App\Http\Requests\API\UpdatevoitureAPIRequest;
use App\Models\voiture;
use App\Repositories\voitureRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class voitureAPIController
 */
class voitureAPIController extends AppBaseController
{
    private voitureRepository $voitureRepository;

    public function __construct(voitureRepository $voitureRepo)
    {
        $this->voitureRepository = $voitureRepo;
    }

    /**
     * Display a listing of the voitures.
     * GET|HEAD /voitures
     */
    public function index(Request $request): JsonResponse
    {
        $voitures = $this->voitureRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($voitures->toArray(), 'Voitures retrieved successfully');
    }

    /**
     * Store a newly created voiture in storage.
     * POST /voitures
     */
    public function store(CreatevoitureAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $voiture = $this->voitureRepository->create($input);

        return $this->sendResponse($voiture->toArray(), 'Voiture saved successfully');
    }

    /**
     * Display the specified voiture.
     * GET|HEAD /voitures/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var voiture $voiture */
        $voiture = $this->voitureRepository->find($id);

        if (empty($voiture)) {
            return $this->sendError('Voiture not found');
        }

        return $this->sendResponse($voiture->toArray(), 'Voiture retrieved successfully');
    }

    /**
     * Update the specified voiture in storage.
     * PUT/PATCH /voitures/{id}
     */
    public function update($id, UpdatevoitureAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var voiture $voiture */
        $voiture = $this->voitureRepository->find($id);

        if (empty($voiture)) {
            return $this->sendError('Voiture not found');
        }

        $voiture = $this->voitureRepository->update($input, $id);

        return $this->sendResponse($voiture->toArray(), 'voiture updated successfully');
    }

    /**
     * Remove the specified voiture from storage.
     * DELETE /voitures/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var voiture $voiture */
        $voiture = $this->voitureRepository->find($id);

        if (empty($voiture)) {
            return $this->sendError('Voiture not found');
        }

        $voiture->delete();

        return $this->sendSuccess('Voiture deleted successfully');
    }
}
