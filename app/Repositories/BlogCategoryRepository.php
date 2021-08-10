<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use DB;
use Illuminate\Support\Collection;

/**
 * Class BlogCategoryRepository.
 * 
 * @package App\Repositories
 */
class BlogCategoryRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * Get model for admin's editing
     * 
     * @param int $id 
     * 
     * @return Model
     *  Return the model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Get categories list for <select> box
     * 
     * @return Collection
     */
    public function  getForCombobox()
    {
        $columns = implode(',', [
            'id',
            'CONCAT (id, ". ", title) AS id_title',
        ]);

        /*
        $result[] = $this
            ->startConditions()
            ->all();
        $result[] = $this
            ->startConditions()
            ->select(
                'blog_categories.*',
                DB::raw('CONCAT (id, ". ", title) AS id_title')
            )
            ->toBase()
            ->get();
        */
        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * Получить категории для вывода пагинатора.
     * 
     * @param int|null $perPage
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);

        return $result;
    }
}
