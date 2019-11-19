<?php

namespace App\External;

use Illuminate\Database\Eloquent\Model;

class ExternalModel extends Model
{
    public $timestamps = false;
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setConnection(env("DB_EXTERNAL_CONNECTION") );
    }
}