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
        try {
            $entities = $this->entityRepository->getAll($category->id);
            return EntitiesCollection::make($entities);
        } catch (NotFoundHttpException $e) {
            return response()->json(['message' => 'NMo existe esa categoria papa!!!!!'], 404);
        }
    }
}
