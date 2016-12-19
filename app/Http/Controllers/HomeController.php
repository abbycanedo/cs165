<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Products;
use App\Carts;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();
    	return view('home')->with('products', $products);
    }

    public function details(Products $id)
    {
        $products = Products::where('id', $id->id)->get();
        return view('products.details')->with('products',$products);
    }

}