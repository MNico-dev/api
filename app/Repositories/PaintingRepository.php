<?php

namespace App\Repositories;

use App\Painting;
use Auth;
use Illuminate\Support\Facades\Validator;


class PaintingRepository extends Repository
{
    public $painting;
    public $validator;

    protected $rules = array(
        'name' => 'required|string|max:100',
        'painter' => 'required|string|max:100',
    );

    public function __construct()
    {
        parent::__construct();
        $this->makeModel();
    }

    function model()
    {
        return Painting::class;
    }

    public function all($columns = array('*'))
    {
        return $this->model->all();
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->model->paginate();
    }

    public function create(array $data)
    {
        if(!$this->validate($data)){
            return false;
        }

        $painting = $this->model->firstOrNew($data)->save();

        return $painting;
    }

    public function update(array $data, $painting_id)
    {

        if(!$this->validate($data)){
            return false;
        }

        $painting = $this->model->find($painting_id);
        $painting->fill($data);

        return !!$painting->save();
    }

    public function delete($id)
    {

        $record = $this->find($id);

        try{
            if($record->static == 1){
                return false;
            }

            return $record->delete($id);
        }catch(\Exception $e){
            return false;
        }

    }

    public function find($id, $columns = array('*'))
    {
        return $this->model->find($id);
    }

    public function findBy($filter, $value, $fields = array('*'))
    {

        return $this->model->where($filter, '=', $value)->first($fields);
    }

    public function search()
    {
        // TODO: Implement search() method.
    }

    private function validate($data = array())
    {
        // validate against the inputs from our form
        $this->validator = Validator::make($data, $this->rules , []);

        // check if the validator failed -----------------------
        return !$this->validator->fails();
    }
}
