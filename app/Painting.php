<?php

namespace App;

use App\External\ExternalModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Painting extends ExternalModel
{
    protected $table = 'painting';

    protected $fillable = ['name','painter'];
    protected $visible = [];
    protected $dates = ['created_at','updated_at','deleted_at'];

    public $timestamps = true;

    use softdeletes;
}
