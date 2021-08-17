<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;

/**
 * Class BlogPostRepository.
 */
class BlogPostRepository extends BaseRepository
{
    /**
     * @return Model
     */
    public function getModelClass()
    {
        return Model::class;
    }
}
