<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Collection;

class EloquentRepository implements PostsRepository
{
    public function search(string $query = ''): Collection
    {
        return Post::query()
            ->where('body', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->get();
    }
}
