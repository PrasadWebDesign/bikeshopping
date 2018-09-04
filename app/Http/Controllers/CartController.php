<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(Cart::content());
        return view('cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // find duplicates bikes in cart
        $duplicates = Cart::search(function($cartItem, $rowId) use($request){
            return $cartItem->id === $request->id;
        });

        // if found return error
        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('status','Bike is already added to the cart');
        }

        // add item to cart and associate it with the model
        // so that we can use it in view to retrive that particular item's properties
        // like say if bullet is in cart and we wanna retrieve it's properties in cart view
        // then we can use this relationship
        Cart::instance('default')->add($request->id,$request->name,1,$request->price)
        ->associate('App\Bike');

        return redirect()->route('cart.index')->with('status','Bike added to cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function emptyCart()
    {
        Cart::destroy();
    }

    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('status','Bike has been removed');
    }


    public function wishlist_index()
    {
        // dd(Cart::content());
        return view('wishlist');
    }

    public function wishliststore(Request $request)
    {
        
        // find duplicates bikes in cart
        $duplicates = Cart::instance('wishlist')->search(function($cartItem, $rowId) use($request){
            return $cartItem->id === $request->id;
        });

        // if found return error
        if ($duplicates->isNotEmpty()) {
            return redirect()->route('wishlist.index')->with('status','Bike is already added to the wishlist');
        }

        // add item to cart and associate it with the model
        // so that we can use it in view to retrive that particular item's properties
        // like say if bullet is in cart and we wanna retrieve it's properties in cart view
        // then we can use this relationship
        Cart::instance('wishlist')->add($request->id,$request->name,1,$request->price)
        ->associate('App\Bike');

        return redirect()->route('wishlist.index')->with('status','Bike added to wishlist');
    }

    public function wishlistdestroy($id)
    {
        Cart::instance('wishlist')->remove($id);
        return back()->with('status','Bike has been removed');
    }

}
