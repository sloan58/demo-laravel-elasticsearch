<?php

namespace App\Models\Posts;

use App\Search\Searchable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Searchable;
}
