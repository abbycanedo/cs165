<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use Auth;
use Validator;
use App\User;
use App\Products;
use App\Http\Requests;
use Redirect;
use Session;
use Image;

class ProductController extends Controller
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
    
    public function index(Request $request)
    {
		if (Auth::user()->isadmin == 1){
            $products = Products::all();
        	return view('products.view')->with('products', $products);
		} else{
			return Redirect::route('home');
        }
    }

    public function add()
    {
        if (Auth::user()->isadmin == 1){
            return view('products.add');
        } else{
            return Redirect::route('home');
        }
    }

    protected function insert(Request $request)
    {
        $image = $request->file('imageurl');

        $data = [];
        $data['name'] = $request['name'];
        $data['brand'] = $request['brand'];
        $data['quantity'] = $request['quantity'];
        $data['price'] = $request['price'];
        $data['description'] = $request['description'];
        $data['imageurl'] = $image;


        $validator = Validator::make($data, [
            'name' => 'required|min:5',
            'brand' => 'required|min:3',
            'imageurl' => 'mimes:jpeg,jpg|required',
            'description' => 'required',
        ]);

        if ($validator->passes()) {
            $product = new Products;
            $product->name = $request['name'];
            $product->brand = $request['brand'];
            $product->code = '0';
            $product->quantity = $request['quantity'];
            if ($request['quantity'] == 0) {
                $product->status = 0;
            } else{
                $product->status = 1;
            }
            $product->price = $request['price'];
            $product->description = $request['description'];
            $product->imageurl = 'null';
            $product->save();

            $saved = Products::where('code', '0')->get();
            $pcode = strtoupper(substr($request['brand'], 0,3).'-'.substr($request['name'], 0, 3).'-'.(string)($saved[0]->id+10000));
            $image_filename = (string)($saved[0]->id).'_'.(string)time().'.jpg';
            Storage::disk('uploads')->put($image_filename, File::get($image));
            Products::where('code', '0')->update(array(
                    'code' => $pcode,
                    'imageurl' => $image_filename,
            ));

            Session::flash('success', "Success! Product added (PRODUCT CODE: ".$pcode.")");
            return Redirect::back();

        } else{
            $error = $validator->errors();
            return Redirect::back()->withErrors($validator);
        }

    }

    public function edit(Products $id)
    {
        if (Auth::user()->isadmin == 1){
            $products = Products::where('id', $id->id)->get();
            return view('products.edit')->with('products', $products);
        } else{
            return "Restricted access!";
        }
    }

    protected function update(Products $id, Request $request)
    {
        $image = $request->file('imageurl');

        $data = [];
        $data['name'] = $request['name'];
        $data['brand'] = $request['brand'];
        $data['quantity'] = $request['quantity'];
        $data['price'] = $request['price'];
        $data['description'] = $request['description'];
        $data['imageurl'] = $image;

        $validator = Validator::make($data, [
            'name' => 'required|min:5',
            'brand' => 'required|min:3',
            'description' => 'required',
            'imageurl' => 'mimes:jpeg,jpg'
        ]);

        if ($validator->passes()) {
            if ($request['quantity'] == 0) {
                $status = 0;
            } else{
                $status = 1;
            }
            Products::where('id', $id->id)->update(array(
                'name' => $request['name'],
                'brand' => $request['brand'],
                'quantity' => $request['quantity'],
                'status' => $status,
                'price' => $request['price'],
                'description' => $request['description'],
            ));

            if($image){
                $image_filename = (string)($id->id).'_'.(string)time().'.jpg';
                Storage::disk('uploads')->put($image_filename, File::get($image));
                Products::where('id', $id->id)->update(array(
                    'imageurl' => $image_filename
                ));
            }

            Session::flash('success', "Success! Product edited.");
            return Redirect::back();
        } else{
            $error = $validator->errors();
            return Redirect::back()->withErrors($validator);
        }


    }

    protected function delete(Products $id)
    {
        $product = Products::find($id->id);    
        $product->delete();
        Session::flash('success', "Success! Product deleted.");
        return Redirect::back();

    }

}
