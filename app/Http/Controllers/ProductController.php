<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Http\Requests;
use App\Product;
use Auth;
use Session;
use Stripe\Stripe;
use Stripe\Charge;
use App\Order;
use View;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    //
    public function getIndex()
    {
        $products = Product::all();
        return view('shop.index', ['products' => $products]);
    }

    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
      //  dd($request->session()->get('cart'));
      return redirect()->route('product.index');
    }

    public function getReduceByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('product.shoppingCart');
    }

    public function getRemoveItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout()
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart -> totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('shop.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        Stripe::setApiKey('sk_test_E2Lmjyld1m3qM9QTT2iEIzvd');
        try {
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "mxn",
                "source" => $request->input('stripeToken'),
                "description" => "Test Charge"
            ));
            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;

            Auth::user()->orders()->save($order);
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }
        Session::forget('cart');
        return redirect()->route('product.index')->with('success', 'Compra exitosa, Gracias.');
    }


    public function index(Request $request)
    {
      // get all the products
      $products = Product::all();

      // load the view and pass the products
      return View::make('products.index')
          ->with('products', $products);
    }

    public function create()
    {
        return View::make('products.create');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'title' => 'required',
        'description' => 'required',
        'imagePath' => 'required',
        'price' => 'required',
        'filter' => 'required',
        'type' => 'required',
      ]);

      if($request->hasFile('imagePath')){
        $imagePath = $request->file('imagePath');
        $filename = time() . '.' . $imagePath->getClientOriginalExtension();
        Image::make($imagePath)->resize(300, 300)->save( public_path('/uploads/productImg/' . $filename ) );
      }

      Product::create($request->all());

      return redirect()->route('products.index')
                    ->with('success','Producto creado.');
    }

    public function show($id)
    {
        $product = Product::find($id);

      // show the view and pass the product to it
      return View::make('products.show')
          ->with('product', $product);
    }

    public function edit($id)
    {
      // get the product
        $product = Product::find($id);

        // show the edit form and pass the product
        return View::make('products.edit')
            ->with('product', $product);

    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'title' => 'required',
        'description' => 'required',
        'imagePath' => 'required',
        'price' => 'required',
        'filter' => 'required',
        'type' => 'required',
      ]);

      Product::find($id)->update($request->all());
      return redirect()->route('products.index')
                ->with('success','Producto actualizado.');
    }

    public function destroy($id)
    {
      Product::find($id)->delete();
      return redirect()->route('products.index')
              ->with('success','Producto borrado.');
    }


    public function showProduct()
    {
      $product = Product::all();
      return view('product.showP', compact('product'));
    }
}
