<?php

namespace App\Repository\Entity;

use App\Models\Entity;
use Illuminate\Database\Eloquent\Collection;


class EntityRepository implements IEntityRepository
{
	public function create(array $data): void
	{
		Entity::insertOrIgnore([
			'api' => $data['API'],
			'description' => $data['Description'],
			'link' => $data['Link'],
			'category_id' => $data['category_id']
		]);
	}
	
	public function getAll(int $category_id): Collection
	{
		$entities = Entity::where('category_id', $category_id)->with('category')->get();
		return $entities;
	}

}