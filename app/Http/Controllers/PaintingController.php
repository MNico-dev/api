<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PaintingRepository;
use App\Http\Resources\PaintingResource;
use App\Http\Resources\PaintingsResource;

class PaintingController extends Controller
{

    protected $repository;

    public function __construct(PaintingRepository $repository){
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paintings = new PaintingsResource($this->repository->all());
        return response()->json($paintings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $painting = $this->repository->create($request->except("_token"));
        return response()->json($painting);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $painting = new PaintingResource($this->repository->find($id));
        return response()->json($painting);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $painting = new PaintingResource($this->repository->find($id));
        return response()->json($painting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updated = $this->repository->update($request->except("_token"),$id);

        if(!$updated){
            return response()->json([
                'updated' => false,
                'error' => true,
                'message' => $this->repository->validator->errors()->all()
            ]);
        }

        return response()->json([
            'updated' => $updated
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $painting = $this->repository->delete($id);
        return response()->json($painting);
    }

    public function filter(Request $request){
        $valueR = array_values($request->input("filter"));
        $fieldsSearch = $request->input("fields");
        $filterKey = key($request->filter);

        $filter = trim($filterKey,"''");
        $value = $valueR[0];
        $fields = explode(",", $fieldsSearch);

        $painting = $this->repository->findBy($filter,$value,$fields);

        return response()->json($painting);
    }
}
