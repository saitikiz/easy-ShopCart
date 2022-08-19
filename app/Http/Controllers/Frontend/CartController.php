<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCartRequest;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    public function index()
    {
        $cart =  Auth::user()->cart;
        if($cart){
            $cart = $cart->load('items.product');
        }
        //return $cart;
        return view('frontend.cart.index', compact('cart'));
    }

    public function itemCount(){
        $cart =  Auth::user()->cart;
        if($cart){
            $count = $cart->items->sum('quantity');
        }else{
            $count=0;
        }
        return $count;
    }

    public function add(Request $request)
    {
        $product_id = $request->product_id;
        //Ürün bul
        $product = Product::where("id",$product_id)->first();

        //Ürün doğrulama
        if($product){
            //User Aktif sepeti (yoksa oluştur)
            $cart = Cart::firstOrCreate([
                'user_id' => Auth::user()->id
            ], [
                'status' => ''
            ]);

            if($cart){
                $cart_item = CartItem::where("product_id",$product->id)->where("cart_id",$cart->id)->first();
                if($cart_item){
                    //Eğer sepetinde aynı ürün var ise 1 arttır
                    $update_request = new Request();
                    $update_request->replace(["product_id"=>$product_id,"quantity"=>++$cart_item->quantity]);
                    $this->update($update_request);
                }else{
                    //sepetinde ürün yok ise yeni ekle
                    CartItem::create([
                        "cart_id"=>$cart->id,
                        "product_id"=>$product->id,
                        "quantity"=>1,//değişken adet parametresine göre güncellenebilir.
                        "options"=>"Ürün beden, renk gibi değişkenleri",
                        "price"=>$product->price,
                    ]);
                }
            }
        }
    }

    public function remove(Request $request)
    {
        $product_id = $request->product_id;

        //Ürün bul
        $product = Product::where("id",$product_id)->first();

        //Ürün doğrulama
        if($product){
            //Usert Aktif sepeti
            $cart = Auth::user()->cart;
            if($cart){
                $cart_item = CartItem::where("product_id",$product->id)->where("cart_id",$cart->id)->delete();
                if($cart->items->count()<1){
                   $this->truncate();
                }
            }else{
                //Sepet Yok
            }
        }

    }

    public function update(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = $request->quantity;

        //Ürün bul
        $product = Product::where("id",$product_id)->first();
        //Ürün doğrulama
        if($product){
            //Sepet bul
            $cart = Auth::user()->cart;
            //Sepet Doğrula
            if($cart){
                $cart_item = CartItem::where("product_id",$product->id)->where("cart_id",$cart->id)->first();
                if($cart_item){
                    if($quantity>0){
                        $cart_item->quantity = $quantity;
                        $cart_item->save();
                    }else{
                        $cart_item->delete();
                    }
                    if($cart->items->count()<1){
                        $this->truncate();
                    }

                }else{
                    //sepette güncellencek item yok , bu esnada sepet oluşturulabilir veya hata dönebilir.
                }
            }else{
                //sepet yok
            }
        }
    }

    public function truncate(){
        $cart = Auth::user()->cart;
        $cart->items()->delete();
        $cart->delete();
    }

}
