<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Validator;
use App\User;
use App\Profiles;
use App\Products;
use App\Carts;
use App\Http\Requests;
use Redirect;
use Session;
use AuthenticatesUsers;
use Expression;
use App\Transactions;

class CartController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
		$this->user =  \Auth::user();
    }

    public function index(User $user)
    {
        date_default_timezone_set('Asia/Hong_Kong');
        if($user->isadmin==0){
			$profile = Profiles::where('users_id', $user->id)->first();
        	$total = Carts::where([['profile_id', $profile->id],['active', 1]])
        						->selectRaw('SUM("price") AS total')
        						->join('products', 'products.id', '=', 'carts.product_id')->get();
        	$products = Products::join('carts', 'products.id', '=', 'carts.product_id')
        						->where([['profile_id', $profile->id],['active', 1]])->get();

	       	// return $cart_id;
	       	return view('cart.view')->with(['products'=>$products, 'total'=>$total]);
	    } else{
	    	return view('home');
	    }
	}

    protected function add(Products $id)
    {
        $user = Auth::user();
        if($user->isadmin==0){
	        $profile = Profiles::where('users_id', $user->id)->first();

	        $cart = new Carts;
	        $cart->profile_id = $profile->id;
	        $cart->transaction_no = $profile->transactions + 1;
	        $cart->product_id = $id->id;
	        $cart->active = 1;
	        $cart->save();

	        Session::flash('success', 'Success! Item '.$id->code.' added to cart.');
	        return Redirect::route('product.details', $id->id);	
        } else{
	        return Redirect::route('product.details', $id->id);	
        }
    }

    protected function delete(Products $id)
    {
        $product = Carts::find($id->id);    
        $product->delete();
        Session::flash('success', "Success! Item removed from cart.");
        return Redirect::back();

    }

    protected function submit(User $user)
    {
        date_default_timezone_set('Asia/Hong_Kong');
        $profile = Profiles::where('users_id', $user->id)->first();
        $total = Carts::where([['profile_id', $profile->id],['active', 1]])
                            ->selectRaw('SUM("price") AS total')
                            ->join('products', 'products.id', '=', 'carts.product_id')->first();
        $carts = Carts::where([['profile_id', $profile->id], ['active', 1]])->get();

        $count = Carts::where([['profile_id', $profile->id],['active', 1]])
                            ->selectRaw('product_id, count(product_id)')
                            ->groupBy('product_id')->get();
        $able = 1;
        $problem = '';

        foreach ($count as $c) {
            $product = Products::where('id', $c->product_id)->first();
            if ($c->count > $product->quantity) {
                $able = 0;
                $problem = $product->code;
            }
        }

        if($able ==  1){
            foreach ($carts as $cart) {
                $product = Products::where('id', $cart->product_id)->first();
                $product->update(array(
                    'quantity' => $product->quantity - 1
                ));
                if ($product->quantity == 0) {
                    $product->update(array(
                        'status' => 0
                    ));
                }
                Carts::where([['profile_id', $profile->id],['active', 1]])->update(array(
                    'active' => 0
                ));                
            }

            $user = Auth::user();
            if($user->isadmin==0){
                $profile = Profiles::where('users_id', $user->id)->first();

                $order = new Transactions;
                $order->transaction_no = $profile->transactions + 1;
                $order->profile_id = $profile->id;
                $order->total = $total->total;
                $order->creator_id = $user->id;
                $order->created_at = date('Y-m-d H:i:s');
                $order->save();

                Profiles::where('id', $profile->id)->update(array(
                    'transactions' => $profile->transactions + 1
                ));

            } else{
                return Redirect::route('product.details', $id->id); 
            }
            Session::flash('success', 'Success! Transaction successfully processed.');
            return Redirect::back();
        } else{
            Session::flash('error', 'Error! Item '.$problem.' in stock is not enough.');
            return Redirect::back();
        }
    }

}
