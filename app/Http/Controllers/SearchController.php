<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('slug', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orWhereHas('farmer', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->orWhereHas('type', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->get();

        // Kembalikan data ke view
        return view('ProdukPage', compact('products', 'query'));
    }
    
}
