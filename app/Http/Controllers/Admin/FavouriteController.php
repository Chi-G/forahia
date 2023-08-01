<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductList;
use App\Models\Favourites;
use App\Models\User;
use Auth;

class FavouriteController extends Controller
{
    public function AddFavourite(Request $request)
    {
        $product_code = $request->product_code;
        $email = $request->email;

        //get details when requested product_code matches product_code in ProductList table
        $productDetails = ProductList::where('product_code', $product_code )->get();

        $result = Favourites::insert([
            'product_name' => $productDetails[0]['title'],
            'image' => $productDetails[0]['image'],
            'product_code' => $product_code,
            'email' => $email,
        ]);

        return $result;
    }// end method

    public function FavouriteList(Request $request)
    {
        $email = $request->email;
        $result = Favourites::where('email', $email)->get();

        return $result;
    }

     public function FavCount(Request $request)
       {
         $product_code = $request->product_code;
         $email = $request->email;

         $result = Favourites::where('email', $email)->count();

           return $result;
       } // End Method

    public function FavouriteRemove(Request $request)
    {
        $product_code = $request->product_code;
        $email = $request->email;

        $result = Favourites::where('product_code', $product_code)->where('email', $email)->delete();

        return $result;
    }//end method
}
