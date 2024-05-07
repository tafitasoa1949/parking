<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatemarqueRequest;
use App\Http\Requests\UpdatemarqueRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\marque;
use App\Repositories\marqueRepository;
use Illuminate\Http\Request;
use Flash;

class marqueController extends AppBaseController
{
    /** @var marqueRepository $marqueRepository*/
    private $marqueRepository;

    public function __construct(marqueRepository $marqueRepo)
    {
        $this->marqueRepository = $marqueRepo;
    }

    /**
     * Display a listing of the marque.
     */
    public function index(Request $request)
    {
        $marques = $this->marqueRepository->paginate(10);

        return view('marques.index')
            ->with('marques', $marques);
    }

    /**
     * Show the form for creating a new marque.
     */
    public function create()
    {
        return view('marques.create');
    }

    /**
     * Store a newly created marque in storage.
     */
    public function store(CreatemarqueRequest $request)
    {
        $input = $request->all();
        $input['id'] = Marque::getId();
        $marque = $this->marqueRepository->create($input);

        Flash::success('Marque saved successfully.');

        return redirect(route('marques.index'));
    }

    /**
     * Display the specified marque.
     */
    public function show($id)
    {
        $marque = $this->marqueRepository->find($id);

        if (empty($marque)) {
            Flash::error('Marque not found');

            return redirect(route('marques.index'));
        }

        return view('marques.show')->with('marque', $marque);
    }

    /**
     * Show the form for editing the specified marque.
     */
    public function edit($id)
    {
        $marque = $this->marqueRepository->find($id);

        if (empty($marque)) {
            Flash::error('Marque not found');

            return redirect(route('marques.index'));
        }

        return view('marques.edit')->with('marque', $marque);
    }

    /**
     * Update the specified marque in storage.
     */
    public function update($id, UpdatemarqueRequest $request)
    {
        $marque = $this->marqueRepository->find($id);

        if (empty($marque)) {
            Flash::error('Marque not found');

            return redirect(route('marques.index'));
        }

        $marque = $this->marqueRepository->update($request->all(), $id);

        Flash::success('Marque updated successfully.');

        return redirect(route('marques.index'));
    }

    /**
     * Remove the specified marque from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $marque = $this->marqueRepository->find($id);

        if (empty($marque)) {
            Flash::error('Marque not found');

            return redirect(route('marques.index'));
        }

        $this->marqueRepository->delete($id);

        Flash::success('Marque deleted successfully.');

        return redirect(route('marques.index'));
    }
}
