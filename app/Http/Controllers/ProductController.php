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

    public function details($id)
    {
        $query = "CALL GetAllProductDetails(?)";
        $productDetails = DB::select($query, [$id]);

        if (empty($productDetails)) {
            abort(404, 'Product not found');
        }

        // Only show warning and prevent deletion for Honingdrop (ID 3)
        $canDelete = $id != 3;

        return view('product.details', [
            'product' => $productDetails[0],
            'canDelete' => $canDelete
        ]);
    }

    public function delete($id)
    {
        // Prevent deletion of Honingdrop (ID 3)
        if ($id == 3) {
            return redirect()->route('product.index')
                ->with('error', 'Dit product kan niet worden verwijderd');
        }

        DB::beginTransaction();
        try {
            // Delete from magazijn first
            DB::table('magazijn')->where('ProductId', $id)->delete();
            
            // Delete from productperallergeen
            DB::table('productperallergeen')->where('ProductId', $id)->delete();
            
            // Delete from productperleverancier
            DB::table('productperleverancier')->where('ProductId', $id)->delete();
            
            // Delete from ProductEinddatumLevering
            DB::table('ProductEinddatumLevering')->where('ProductId', $id)->delete();
            
            // Finally delete the product
            DB::table('product')->where('Id', $id)->delete();
            
            DB::commit();
            return redirect()->route('product.index')
                ->with('success', 'Product is succesvol verwijderd');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('product.index')
                ->with('error', 'Er is een fout opgetreden bij het verwijderen van het product');
        }
    }
}
