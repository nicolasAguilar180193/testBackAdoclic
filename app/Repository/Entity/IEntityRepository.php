<?php

namespace App\Repository\Entity;

use App\Models\Entity;
use Illuminate\Database\Eloquent\Collection;

interface IEntityRepository
{
	public function create(array $data): void;
	public function getAll(int $category_id): Collection;
}