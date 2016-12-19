<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Validator;
use App\User;
use App\Products;
use App\Profiles;
use App\Transactions;
use App\Carts;
use Session;
use Redirect;

class TransactionController extends Controller
{
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
    
    public function index(Request $request, User $user)
    {
        if ($user->isadmin == 1) {
            $profiles = Profiles::join('users', 'profiles.users_id', '=', 'users.id')->get();
            $transactions = Transactions::join('profiles', 'transactions.profile_id', '=', 'profiles.id')
                                            ->join('users', 'profiles.users_id', '=', 'users.id')
                                            ->where('creator_id', $this->user->id)->get();
            $carts = Carts::join('products', 'products.id', '=', 'carts.product_id')->where('active', 0)->get();
            $isadmin = 1;
        } else{
            $profiles = Profiles::where('users_id', $user->id)->get();
            $profile = Profiles::where('users_id', $user->id)->first();
            $transactions = Transactions::join('users', 'transactions.creator_id', '=', 'users.id')
                                            ->where('profile_id', $profile->id)->get();
            $carts = Carts::join('products', 'products.id', '=', 'carts.product_id')
                            ->where([['profile_id', $profile->id], ['active', 0]])->get();
            $isadmin = 0;
        }
        $profiles = Profiles::join('users', 'profiles.users_id', '=', 'users.id')->get();
        return view('transaction.view')->with(['transactions'=>$transactions, 'carts'=>$carts, 'profiles'=>$profiles, 'isadmin'=>$isadmin]);
    }

    public function add()
    {
		if (Auth::user()->isadmin == 1){
            $products = Products::where('status', 1)->get();
            $profiles = User::where('isadmin', 0)->get();
	       	return view('transaction.add')->with(['products'=>$products, 'profiles'=>$profiles]);
		} else{
			return Redirect::route('home');
        }
    }

    protected function insert(Request $request, User $user)
    {
        date_default_timezone_set('Asia/Hong_Kong');
    	$profile = Profiles::where('users_id', $request['profile_id'])->first();
    	$product = Products::where('id', $request['product_id'])->first();
    	//insert to cart
        $cart = new Carts;
        $cart->profile_id = $profile->id;
        $cart->transaction_no = $profile->transactions + 1;
        $cart->product_id = $product->id;
        $cart->active = 1;
        $cart->save();

        $total = Carts::where([['profile_id', $profile->id],['active', 1]])
                            ->selectRaw('SUM("price") AS total')
                            ->join('products', 'products.id', '=', 'carts.product_id')->first();

        $order = new Transactions;
        $order->transaction_no = $profile->transactions + 1;
        $order->profile_id = $profile->id;
        $order->total = $total->total;
        $order->creator_id = $user->id;
        $order->created_at = date('Y-m-d H:i:s');
        $order->save();

        Carts::where([['profile_id', $profile->id],['active', 1]])->update(array(
            'active' => 0
        ));
        
        Profiles::where('id', $profile->id)->update(array(
            'transactions' => $profile->transactions + 1
        ));

        Products::where('id', $product->id)->update(array(
            'quantity' => $product->quantity - 1
        ));

        if ($product->quantity == 0) {
            Products::where('id', $product->id)->update(array(
                'status' => 0
            ));
            
        }

	    Session::flash('success', 'Success! Transaction successfully processed.');
	    return Redirect::back();
    }

    public function view(Request $request)
    {
        return Redirect::route('transaction.user', $request['user_id']);
    }
    //
}
 