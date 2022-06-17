<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariation;
use App\Models\Transaction;
use App\Models\UserAddress;
use App\PaymentGateway\Pay;
use App\PaymentGateway\Zarinpal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
            'payment_method' => 'required',

        ]);


        if ($validator->fails()) {
            alert()->error('دقت کنید', 'انتخاب آدرس تحویل سفارش الزامی می باشد')->persistent('حله');
            return redirect()->back();
        }

        $checkCart = $this->checkCart();

        if (array_key_exists('error', $checkCart)) {
            alert()->error('دقت کنید', $checkCart['error']);
            return redirect()->route('home.index');
        }

        $amounts = $this->getAmounts();
        if (array_key_exists('error', $amounts)) {
            alert()->error('دقت کنید', $amounts['error']);
            return redirect()->route('home.index');
        }


        if($request->payment_method == 'pay'){

            $payGateway = new Pay();
            $payGatewayResult = $payGateway->send($amounts, $request->address_id);
            if (array_key_exists('error', $payGatewayResult)) {
                alert()->error($payGatewayResult['error'], 'دقت کنید')->persistent('حله');
                return redirect()->back();
            } else {
                return redirect()->to($payGatewayResult['success']);
            }
        }


    if($request->payment_method == 'zarinpal'){


        $zarinpalGateway = new Zarinpal();
        $zarinpalGatewayResult = $zarinpalGateway->send($amounts ,'خرید تستی', $request->address_id);
        if (array_key_exists('error', $zarinpalGatewayResult )) {
            alert()->error($zarinpalGatewayResult['error'], 'دقت کنید')->persistent('حله');
            return redirect()->back();
        } else {
            return redirect()->to($zarinpalGatewayResult['success']);
        }
    }

    alert()->error('دقت کنید', 'درگاه پرداخت انتخابی اشتباه می باشد');
    return redirect()->back();



    }


    public function paymentVerify(Request $request, $gatewayName)
    {

        dd('test');
        if($gatewayName == 'pay'){


            $payGateway = new Pay();
            $payGatewayResult = $payGateway->verify($request->token, $request->status);
            if (array_key_exists('error', $payGatewayResult)) {
                alert()->error($payGatewayResult['error'], 'دقت کنید')->persistent('حله');
                return redirect()->back();
            } else {
                alert()->success($payGatewayResult['success'], 'با تشکر');
                return redirect()->route('home.index');
            }
        }


        if($gatewayName == 'zarinpal'){

            $amounts = $this->getAmounts();
            if (array_key_exists('error', $amounts)) {
                alert()->error('دقت کنید', $amounts['error']);
                return redirect()->route('home.index');
            }
    
    
            $zarinpalGateway = new Zarinpal();
            $zarinpalGatewayResult = $zarinpalGateway->verify($request->Authority,$amounts['paying_amount']);
            if (array_key_exists('error', $zarinpalGatewayResult)) {
                alert()->error($zarinpalGatewayResult['error'], 'دقت کنید')->persistent('حله');
                return redirect()->back();
            } else {
                alert()->success($zarinpalGatewayResult['success'], 'با تشکر');
                return redirect()->route('home.index');
            }

        }


        
    alert()->error('دقت کنید', 'مسیر بازگشت از درگاه پرداخت اشتباه می باشد');
    return redirect()->route('home.orders.checkout');

    }



    public function checkCart()
    {

        if (\Cart::isEmpty()) {
            return ['error' => 'سبد خرید شما خالی می باشد'];
        }

        foreach (\Cart::getContent() as $item) {
            $variation = ProductVariation::find($item->attributes->id);

            $price = $variation->is_sale ? $variation->sale_price : $variation->price;

            if ($item->price != $price) {
                \Cart::clear();
                return ['error' => 'قیمت محصول تغییر یافته است'];
            }
            if ($item->quantity > $variation->quantity) {
                \Cart::clear();
                return ['error' => 'تعداد محصول تغییر یافته است '];
            }

            return ['success' => 'success!'];
        }
    }


    public function getAmounts()
    {

        if (session()->has('coupon')) {

            $checkCoupon = checkCoupon(session()->get('coupon.code'));
            if (array_key_exists('error', $checkCoupon)) {
                return $checkCoupon;
            }
        }




        return [
            'total_amount' => (\Cart::getTotal() + cartTotalSaleAmount()),
            'delivery_amount' => cartTotalDeliveryAmount(),
            'coupon_amount' => session()->has('coupon') ? session()->get('coupon.amount') : 0,
            'paying_amount' => cartTotalAmount(),

        ];
    }
}
