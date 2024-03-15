<?php

namespace App\Http\Controllers;

use App\Http\Resources\EntitiesCollection;
use App\Models\Category;
use App\Models\Entity;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EntitiesController extends Controller
{
    public function getEntitiesByCategory(Category $category): EntitiesCollection
    {
        try {
            $entities = Entity::where('category_id', $category->id)->with('category')->get();
            return EntitiesCollection::make($entities);
        } catch (NotFoundHttpException $e) {
            // throw new NotFoundHttpException('NMo existe esa categoria papa!!!!!');
            return response()->json(['message' => 'NMo existe esa categoria papa!!!!!'], 404);
        }
    }
}
