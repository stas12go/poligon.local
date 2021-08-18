<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Pagination\LengthAwarePaginator;

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

    /**
     * Получить категории для вывода пагинатора
     * в админке.
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->with([
                'category' => function ($query) {
                    $query->select(['id', 'title']);
                },
                'user:id,name'
            ])
            ->orderBy('id', 'DESC')
            ->paginate(25);

        return $result;
    }
}
