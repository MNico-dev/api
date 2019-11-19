<?php
namespace App\Repositories;


use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use \App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class Repository
 * @package App\Repositories\Eloquent
 */
abstract class Repository implements RepositoryInterface {

    /**
     * @var
     */
    protected $model;

    protected $db;

    protected $request;

    /**
     * @param App $app
     * @throws \App\Repositories\Exceptions\RepositoryException
     */
    public function __construct() {
    }

    abstract public function model();

    /**
     * @return Model
     * @throws RepositoryException
     */
    public function makeModel() {
        $model = App::make($this->model());

        if (!$model instanceof Model)
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model;
    }

    /**
     * @param mixed $db
     */
    public function setDb($db = "")
    {
        $this->db = DB::connection($db);

    }

    /**
     * @return mixed
     */
    public function DB()
    {
        return $this->db;
    }

    /**
     * @param mixed $db
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;

    }

    /**
     * @return mixed
     */
    public function request()
    {
        return $this->request;
    }
}
