<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SaveDistrict;
use App\Models\Deputy;
use App\Http\Controllers\Controller;

class DeputyController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = Deputy::class;
        $this->viewName = str_plural(last(explode('\\', strtolower($this->model))));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = $this->model::orderBy('created_at', 'DESC')->paginate();
        $viewName = $this->viewName;

        return view("admin.$this->viewName.index", compact('entities', 'viewName'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $viewName = $this->viewName;
        $entity = new $this->model();

        return view("admin.$this->viewName.edit", compact( 'viewName', 'entity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SaveDistrict  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveDistrict $request)
    {
        $this->save($request);

        return redirect()->route("admin.$this->viewName.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $viewName = $this->viewName;
        $entity = $this->model::findOrFail($id);

        return view("admin.$this->viewName.edit", compact( 'viewName', 'entity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveDistrict $request, $id)
    {
        $this->save($request, $id);

        return redirect()->route("admin.$this->viewName.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** @var Model $entity */
        $entity = $this->model::findOrFail($id);

        $entity->delete();

        return redirect()->route("admin.$this->viewName.index");
    }

    /**
     * @param SaveDistrict $request
     */
    private function save(SaveDistrict $request, $id = null)
    {
        if ($id) {
            $entity = $this->model::findOrFail($id);
        } else {
            $entity = $this->model::findOrNew($id);
        }

        $entity->name = $request->get('name');
        $entity->polygon = $request->get('polygon');

        return $entity->save();
    }
}
