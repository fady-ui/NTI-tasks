<?php

namespace App\Http\Controllers\Apis;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Subcategory;
use App\Http\Services\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\traits\ApiTrait;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return ApiTrait::data(compact('products'));
    }

    public function create()
    {
        $brands = Brand::select('id', 'name_en', 'name_ar')->get();
        $subcategories = Subcategory::select('id', 'name_en', 'name_ar')->get();

        return ApiTrait::data(compact('brands', 'subcategories'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::select('id', 'name_en', 'name_ar')->get();
        $subcategories = Subcategory::select('id', 'name_en', 'name_ar')->get();
        return ApiTrait::data(compact('product', 'brands', 'subcategories'));
    }

    public function store(StoreProductRequest $request)
    {
        $productImage = Media::upload($request->file('image'), 'products');

        $data = $request->except('image');
        $data['image'] = $productImage;
        Product::create($data);
        return ApiTrait::successMessage('product created');
    }

    public function update(UpdateProductRequest $request, $id)
    {

        $product =  Product::findOrFail($id);

        $data = $request->except('image');
        if ($request->hasFile('image')) {

            //upload image
            $productImage = Media::upload($request->file('image'), 'products');
            //delete old image
            $oldImage = public_path("assets\images\products\\{$product->image}");
            Media::delete($oldImage);

            //push new image into data array
            $data['image'] = $productImage;
        }

        $product->update($data);
        return ApiTrait::successMessage('product updated');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        //delete old image
        $oldImage = public_path("assets\images\products\\{$product->image}");
        Media::delete($oldImage);

        $product->delete();
        return ApiTrait::successMessage('product deleted');
    }
}
