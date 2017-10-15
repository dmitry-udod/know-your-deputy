<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SaveTheme;
use App\Models\District;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = District::class;
        $this->viewName = str_plural(last(explode('\\', strtolower($this->model))));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entities = $this->model::with('category')->orderBy('created_at', 'DESC')->paginate();
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
     * @param  SaveTheme  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveTheme $request)
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
    public function update(SaveTheme $request, $id)
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

        logger()->info("Admin {$this->user->name} delete $entity->title", []);

        return redirect()->route("admin.$this->viewName.index");
    }

    /**
     * @param SaveTheme $request
     */
    private function save(SaveTheme $request, $id = null)
    {
        if ($id) {
            $entity = $this->model::findOrFail($id);
        } else {
            $entity = $this->model::findOrNew($id);
        }

        $entity->title = $request->get('title');
        $entity->slug = str_slug($request->get('title'));
        $entity->html = $request->get('html');
        $entity->is_published = $request->get('is_published', false);
        $entity->theme_category_id = $request->get('theme_category_id');
        $fileData = $this->uploadFile('preview_image', 'themes');
        if ($fileData) {
            $entity->preview_image = $fileData;
        }

        if (!$entity->created_by) {
            $entity->created_by = $this->user->id;
        }

        return $entity->save();
    }
}
