<?php

namespace App\Repositories;

use App\Models\Category;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Interface CategoryRepository.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepository extends BaseRepository
{
    /**
     * Returns the current Model instance
     *
     * @return Model
     */
    public function model()
    {
        return Category::class;
    }
}