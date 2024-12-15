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
            })->with(['orders'])
            ->paginate(12);

        // Kembalikan data ke view
        return view('ProdukPage', compact('products', 'query'));
    }

    public function loadMoreProducts(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('slug', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orWhereHas('farmer', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })
            ->orWhereHas('type', function ($q) use ($query) {
                $q->where('name', 'like', "%$query%");
            })->with(['orders'])
            ->paginate(perPage: 12);

        return view('partials.product', compact('products'))->render();
    }
    
}
