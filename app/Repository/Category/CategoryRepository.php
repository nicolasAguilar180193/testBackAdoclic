<?php

namespace App\Repository\Category;

use App\Models\Category;

class CategoryRepository implements ICategoryRepository
{
	public function getByName(string $name): Category | null
	{
		return Category::where('category', $name)->first();
	}
}