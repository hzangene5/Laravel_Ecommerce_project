<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{
   public function add(Product $product){
     
    if(session()->has('compareProducts')){

         if(in_array($product->id, session()->get('compareProducts'))) {

            alert()->warning('دقت کنید ', 'محصول مورد نظر به لیست مقایسه اضافه شده است');
            return redirect()->back();

         }
        session()->push('compareProducts', [$product->id]);
        
    }else{
        session()->put('compareProducts', [$product->id]);
    }
  
    alert()->success('با تشکر', 'محصول مورد نظر به لیست مقایسه اضافه شد');
    return redirect()->back();

   }


   
   public function index()
    {
        if (session()->has('compareProducts')) {

            $products = Product::find(session()->get('compareProducts'));

            return view('home.compare.index', compact('products'));
        }

        alert()->warning('در ابتدا باید محصولی برای مقایسه اضافه کنید', 'دقت کنید');
        return redirect()->back();
    }




public function remove($prodcutId)
{
    if (session()->has('compareProducts')) {
    
        foreach (session()->get('compareProducts') as $key => $item) {
            if ($item == $prodcutId) {
                session()->pull('compareProducts.' . $key);
            }
        }
        dd(session()->get('compareProducts'));
        if (session()->get('compareProducts') == []) {
            session()->forget('compareProducts');
            return redirect()->route('home.index');
        }
        return redirect()->route('home.compare.index');
    }

    alert()->warning('در ابتدا باید محصولی برای مقایسه اضافه کنید', 'دقت کنید');
    return redirect()->back();
}
}