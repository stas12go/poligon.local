<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
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
    public function getForCombobox()
    {
        return $this->startConditions()->all();
    }
}
