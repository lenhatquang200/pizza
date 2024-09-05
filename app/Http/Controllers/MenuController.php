<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        // Build the query based on filters
        $query = Product::query();

        // Filter by category if selected
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by name if provided
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    // Default sorting logic, if needed
                    break;
            }
        }
        // Get the filtered products with pagination
        $products = $query->paginate(9); // Adjust the number of products per page as needed

        // Return the view with products and categories
        return view('menu', compact('products', 'categories'));
    }
}
