<?php

namespace App\Http\Controllers;

use App\Http\Resources\EntitiesCollection;
use App\Models\Category;
use App\Repository\Entity\IEntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EntitiesController extends Controller
{

    public function __construct(private IEntityRepository $entityRepository) { }

    public function getEntitiesByCategory(Category $category): EntitiesCollection
    {
        $entities = $this->entityRepository->getAll($category->id);
        return EntitiesCollection::make($entities);
    }
}
