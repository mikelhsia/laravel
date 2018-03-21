<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // construct fillable format to accept the data that valid by internal controller
    // PostsController.php
    protected $fillable = ['title', 'body'];
}
