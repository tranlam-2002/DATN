<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');
        $products = Product::where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%')
                            ->get();

        return view('search.results', 
        ['products' => $products, 'query' => $query],[
            'title'=>'Tìm kiếm sản phẩm'
        ]);
    }
}