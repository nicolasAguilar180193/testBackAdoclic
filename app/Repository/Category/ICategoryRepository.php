<?php

namespace App\Repository\Category;

use App\Models\Category;

interface ICategoryRepository
{
	public function getByName(string $name): Category | null;
}