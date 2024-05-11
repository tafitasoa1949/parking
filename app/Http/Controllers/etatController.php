<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateetatRequest;
use App\Http\Requests\UpdateetatRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\etatRepository;
use Illuminate\Http\Request;
use Flash;

class etatController extends AppBaseController
{
    /** @var etatRepository $etatRepository*/
    private $etatRepository;

    public function __construct(etatRepository $etatRepo)
    {
        $this->etatRepository = $etatRepo;
    }

    /**
     * Display a listing of the etat.
     */
    public function index(Request $request)
    {
        $etats = $this->etatRepository->paginate(10);

        return view('etats.index')
            ->with('etats', $etats);
    }

    /**
     * Show the form for creating a new etat.
     */
    public function create()
    {
        return view('etats.create');
    }

    /**
     * Store a newly created etat in storage.
     */
    public function store(CreateetatRequest $request)
    {
        $input = $request->all();

        $etat = $this->etatRepository->create($input);

        Flash::success('Etat saved successfully.');

        return redirect(route('etats.index'));
    }

    /**
     * Display the specified etat.
     */
    public function show($id)
    {
        $etat = $this->etatRepository->find($id);

        if (empty($etat)) {
            Flash::error('Etat not found');

            return redirect(route('etats.index'));
        }

        return view('etats.show')->with('etat', $etat);
    }

    /**
     * Show the form for editing the specified etat.
     */
    public function edit($id)
    {
        $etat = $this->etatRepository->find($id);

        if (empty($etat)) {
            Flash::error('Etat not found');

            return redirect(route('etats.index'));
        }

        return view('etats.edit')->with('etat', $etat);
    }

    /**
     * Update the specified etat in storage.
     */
    public function update($id, UpdateetatRequest $request)
    {
        $etat = $this->etatRepository->find($id);

        if (empty($etat)) {
            Flash::error('Etat not found');

            return redirect(route('etats.index'));
        }

        $etat = $this->etatRepository->update($request->all(), $id);

        Flash::success('Etat updated successfully.');

        return redirect(route('etats.index'));
    }

    /**
     * Remove the specified etat from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $etat = $this->etatRepository->find($id);

        if (empty($etat)) {
            Flash::error('Etat not found');

            return redirect(route('etats.index'));
        }

        $this->etatRepository->delete($id);

        Flash::success('Etat deleted successfully.');

        return redirect(route('etats.index'));
    }
}
