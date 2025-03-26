<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $startdatum = $request->query('startdatum');
        $einddatum = $request->query('einddatum');

        $query = "CALL GetAllProducts()";
        $products = collect(DB::select($query));

        if ($startdatum) {
            $products = $products->filter(function ($product) use ($startdatum) {
                return $product->DatumLevering >= $startdatum;
            });
        }

        if ($einddatum) {
            $products = $products->filter(function ($product) use ($einddatum) {
                return $product->DatumLevering <= $einddatum;
            });
        }

        return view('product.index', ['products' => $products]);
    }
}
