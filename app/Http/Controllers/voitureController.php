<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatevoitureRequest;
use App\Http\Requests\UpdatevoitureRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\voitureRepository;
use Illuminate\Http\Request;
use Flash;

class voitureController extends AppBaseController
{
    /** @var voitureRepository $voitureRepository*/
    private $voitureRepository;

    public function __construct(voitureRepository $voitureRepo)
    {
        $this->voitureRepository = $voitureRepo;
    }

    /**
     * Display a listing of the voiture.
     */
    public function index(Request $request)
    {
        $voitures = $this->voitureRepository->paginate(10);

        return view('voitures.index')
            ->with('voitures', $voitures);
    }

    /**
     * Show the form for creating a new voiture.
     */
    public function create()
    {
        return view('voitures.create');
    }

    /**
     * Store a newly created voiture in storage.
     */
    public function store(CreatevoitureRequest $request)
    {
        $input = $request->all();

        $voiture = $this->voitureRepository->create($input);

        Flash::success('Voiture saved successfully.');

        return redirect(route('voitures.index'));
    }

    /**
     * Display the specified voiture.
     */
    public function show($id)
    {
        $voiture = $this->voitureRepository->find($id);

        if (empty($voiture)) {
            Flash::error('Voiture not found');

            return redirect(route('voitures.index'));
        }

        return view('voitures.show')->with('voiture', $voiture);
    }

    /**
     * Show the form for editing the specified voiture.
     */
    public function edit($id)
    {
        $voiture = $this->voitureRepository->find($id);

        if (empty($voiture)) {
            Flash::error('Voiture not found');

            return redirect(route('voitures.index'));
        }

        return view('voitures.edit')->with('voiture', $voiture);
    }

    /**
     * Update the specified voiture in storage.
     */
    public function update($id, UpdatevoitureRequest $request)
    {
        $voiture = $this->voitureRepository->find($id);

        if (empty($voiture)) {
            Flash::error('Voiture not found');

            return redirect(route('voitures.index'));
        }

        $voiture = $this->voitureRepository->update($request->all(), $id);

        Flash::success('Voiture updated successfully.');

        return redirect(route('voitures.index'));
    }

    /**
     * Remove the specified voiture from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $voiture = $this->voitureRepository->find($id);

        if (empty($voiture)) {
            Flash::error('Voiture not found');

            return redirect(route('voitures.index'));
        }

        $this->voitureRepository->delete($id);

        Flash::success('Voiture deleted successfully.');

        return redirect(route('voitures.index'));
    }
}
