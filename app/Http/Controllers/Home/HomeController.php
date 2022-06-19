<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\ContactUs;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;

class HomeController extends Controller
{
    public function index(){
        
      SEOTools::setTitle('Home');
      SEOTools::setDescription('This is my page description');
      SEOTools::opengraph()->setUrl(route('home.index'));
      SEOTools::setCanonical('https://codecasts.com.br/lesson');
      SEOTools::opengraph()->addProperty('type', 'articles');
      SEOTools::twitter()->setSite('@LuizVinicius73');
      SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');





        $sliders = Banner::where('type', 'slider')->where('is_active', 1)->orderBy('priority')->get();
        $indexTopBanners = Banner::where('type', 'index-top')->where('is_active', 1)->orderBy('priority')->get();
        $indexBottomBanners = Banner::where('type', 'index-bottom')->where('is_active', 1)->orderBy('priority')->get();

        $products = Product::where('is_active',  1 )->get()->take(20);
        return view('home.sections.index', compact('sliders', 'indexTopBanners','indexBottomBanners','products'));
    }


    public function aboutUs()
    {
        $bottomBanners = Banner::where('type', 'index-bottom')->where('is_active', 1)->orderBy('priority')->get();
        return view('home.about-us', compact('bottomBanners'));
    }

    public function contactUs()
    {
        $setting = Setting::findOrFail(1);
        return view('home.contact-us', compact('setting'));
    }

    public function contactUsForm(Request $request)
    {
    
      $request->validate([

         'name' => 'required|string|min:3|max:50',
         'email' => 'required|email',
         'subject' => 'required|string|min:4|max:50',
         'text' => 'required|string|min:4|max:3000',
         'g-recaptcha-response' => [new GoogleReCaptchaV3ValidationRule('contact_us')]
         
      ]);

      ContactUs::create([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'text' => $request->text,

      ]);

      alert()->success('پیام شما با موفقیت ثبت شد' , 'باتشکر');
      return redirect()->back();

    }
}
//"spatie/laravel-ignition": "^1.0"