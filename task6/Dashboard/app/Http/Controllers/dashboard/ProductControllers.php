<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductControllers extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();
        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        $subcategories = DB::table('subcategories')->select('id', 'name_en')->get();
        $brands = DB::table('brands')->select('id', 'name_en')->get();
        return view('dashboard.products.create', compact('subcategories', 'brands'));
    }

    public function edit($id)
    {
        $subcategories = DB::table('subcategories')->select('id', 'name_en')->get();
        $brands = DB::table('brands')->select('id', 'name_en')->get();

        $product = DB::table('products')->where('id', $id)->first();
        if (is_null($product)) {
            abort(404);
        }
        return view('dashboard.products.edit', compact('subcategories', 'brands', 'product'));
    }

    public function store(StoreProductRequest $request)
    {
        //validation in StoreProductRequest class in requests folder

        //upload image
        $productImage = Media::upload($request->file('image'), 'products');

        $data = $request->except('_token', 'image');
        $data['image'] = $productImage;
        DB::table('products')->insert($data);

        return redirect()->route('dashboard.products.index')->with('success', 'product inserted successful');
    }


    public function update(UpdateProductRequest $request, $id)
    {
        //validation in UpdateProductRequest class in requests folder

        $product = DB::table('products')->find($id);
        if (is_null($product)) {
            abort(404);
        }

        $data = $request->except('_token', '_method', 'image');
        if ($request->hasFile('image')) {

            //upload image
            $productImage = Media::upload($request->file('image'), 'products');
            //delete old image
            $oldImage = public_path("assets\images\products\\{$product->image}");
            Media::delete($oldImage);

            //push new image into data array
            $data['image'] = $productImage;
        }

        DB::table('products')->where('id', $id)->update($data);

        return redirect()->route('dashboard.products.index')->with('success', 'product updated successful');
    }

    public function distroy($id)
    {
        $product = DB::table('products')->find($id);
        if (is_null($product)) {
            abort(404);
        }

        //delete old image
        $oldImage = public_path("assets\images\products\\{$product->image}");
        Media::delete($oldImage);

        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('dashboard.products.index')->with('success', 'product deleted successful');
    }

    public function toggleStatus(Request $request, $id)
    {
        DB::table('products')->where('id', $id)->update(['status' => (int) !$request->input('status')]);
        return redirect()->route('dashboard.products.index')->with('success', 'product Status Updated successful');
    }
}
