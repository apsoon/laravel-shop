<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class SpecificationOption extends Model
{
    //
    protected $table = "specification_option";

    protected $fillable = ['specification_id', 'name'];
}
