<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCrudRequest;
use App\Http\Requests\UpdateCrudRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Amoureuse;
use App\Models\Diplome;
use App\Models\Genre;
use App\Repositories\CrudRepository;
use Illuminate\Http\Request;
use Flash;

class CrudController extends AppBaseController
{
    /** @var CrudRepository $crudRepository*/
    private $crudRepository;

    public function __construct(CrudRepository $crudRepo)
    {
        $this->crudRepository = $crudRepo;
    }

    /**
     * Display a listing of the Crud.
     */
    public function index(Request $request)
    {
        $cruds = $this->crudRepository->paginate(10);

        return view('cruds.index')
            ->with('cruds', $cruds);
    }

    /**
     * Show the form for creating a new Crud.
     */
    public function create()
    {
        return view('cruds.create',[
            'genres' => Genre::all(),
            'diplomes' => Diplome::all(),
            'amoureuses' => Amoureuse::all()
        ]);
    }

    /**
     * Store a newly created Crud in storage.
     */
    public function store(CreateCrudRequest $request)
    {
        $input = $request->all();
        dd($request->all());
        //$crud = $this->crudRepository->create($input);

        Flash::success('Crud saved successfully.');

        return redirect(route('cruds.index'));
    }

    /**
     * Display the specified Crud.
     */
    public function show($id)
    {
        $crud = $this->crudRepository->find($id);

        if (empty($crud)) {
            Flash::error('Crud not found');

            return redirect(route('cruds.index'));
        }

        return view('cruds.show')->with('crud', $crud);
    }

    /**
     * Show the form for editing the specified Crud.
     */
    public function edit($id)
    {
        $crud = $this->crudRepository->find($id);

        if (empty($crud)) {
            Flash::error('Crud not found');

            return redirect(route('cruds.index'));
        }

        return view('cruds.edit')->with('crud', $crud);
    }

    /**
     * Update the specified Crud in storage.
     */
    public function update($id, UpdateCrudRequest $request)
    {
        $crud = $this->crudRepository->find($id);

        if (empty($crud)) {
            Flash::error('Crud not found');

            return redirect(route('cruds.index'));
        }

        $crud = $this->crudRepository->update($request->all(), $id);

        Flash::success('Crud updated successfully.');

        return redirect(route('cruds.index'));
    }

    /**
     * Remove the specified Crud from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $crud = $this->crudRepository->find($id);

        if (empty($crud)) {
            Flash::error('Crud not found');

            return redirect(route('cruds.index'));
        }

        $this->crudRepository->delete($id);

        Flash::success('Crud deleted successfully.');

        return redirect(route('cruds.index'));
    }
    public function front(){
        return view('cruds.test');
    }
}
