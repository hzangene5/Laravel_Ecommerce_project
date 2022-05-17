<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $tags = Tag::all();

        $categories = Category::where('parent_id', '!=', 0)->get();

        return view('admin.products.create', compact('brands', 'tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

      //  $request->validate([
      //      'name' => 'required',
       //     'brand_id' => 'required',
         //   'is_active' => 'required',
         //   'tag_ids' => 'required',
          //  'description' => 'required',
         //   'primary_image' => 'required|mimes:jpg,jpeg,png,svg',
          //  'images' => 'required',
          //  'images.*' => 'mimes:jpg,jpeg,png,svg',
          //  'category_id' => 'required',
           // 'attribute_ids' => 'required',
           // 'attribute_ids.*' => 'required',
           // 'variation_values' => 'required',
          //  'variation_values.*.*' => 'required',
          //  'variation_values.price.*' => 'integer',
         //   'variation_values.quantity.*' => 'integer',
         //   'delivery_amount' => 'required|integer',
           // 'delivery_amount_per_product' => 'nullable|integer',

       // ]);
      $productImageController = new ProductImageController();
      $fileNameImages =  $productImageController->upload($request->primary_image , $request->images);

     $product = Product::create([
          'name' => $request->name,
          'brand_id' => $request->brand_id,
          'category_id' => $request->category_id,
          'primary_image' =>$fileNameImages['fileNamePrimaryImage'],
          'description' =>$request->description,
          'is_active' =>$request->is_active,
          'delivery_amount' =>$request->delivery_amount,
          'delivery_amount_per_product' =>$request->delivery_amount_per_product,
     ]);

      foreach ($fileNameImages['fileNameImages'] as $fileNameImage) {
          ProductImage::create([
              'product_id' => $product->id,
              'image' =>$fileNameImage
          ]);
      }
      $ProductAttributeController = new ProductAttributeController();
      $ProductAttributeController->store($request->attribute_ids, $product);
      

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
