<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class FrontendController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function searchResults(Request $request)
    {
        $query = $request->input('search');
        $stores = Store::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', "%{$query}%")
                                 ->orWhere('address', 'like', "%{$query}%");
        })->get();

        return view('search-results-mark-map', compact('stores'));
    }

    public function searchRetailNames(Request $request)
    {
        $query = $request->input('query');

        $stores = Store::where('name', 'LIKE', "%{$query}%")
                    ->select('name', 'address', 'latitude', 'longitude')
                    ->get();

        return response()->json($stores);
    }

}
