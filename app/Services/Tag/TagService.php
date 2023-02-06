<?php

namespace App\Services\Tag;

use App\Repositories\TagRepository;

class TagService extends TagRepository
{

    public function __construct(protected TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function create(array $data)
    {
        return $this->tagRepository->create($data);
    }

    public function paginated()
    {
        return $this->tagRepository->paginate(3);
    }

    public function find($id, $columns = ['*'])
    {
        return $this->tagRepository->find($id);
    }

    public function update(array $attributes, $id)
    {
        return $this->tagRepository->update($attributes, $id);
    }

    public function delete($id)
    {
        return $this->tagRepository->delete($id);
    }
}