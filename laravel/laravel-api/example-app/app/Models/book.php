<?php

namespace App\Models;

use illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[fillable(['title', 'author', 'publish_year'])]
class book extends Model
{
    public $timestamps = false;
}
