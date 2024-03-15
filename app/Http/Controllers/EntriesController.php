<?php

namespace App\Http\Controllers;

use App\Services\EntriesApiService;
use Illuminate\Http\Request;

class EntriesController extends Controller
{

    public function __construct(private EntriesApiService $entriesApiService) {}

    public function getEntries()
    {
        $entries = $this->entriesApiService->getEntries();
        return response()->json(['message' => $entries]);
    }
}
