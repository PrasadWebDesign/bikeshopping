<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


class CheckoutController extends Controller
{


    private function getNewValues(){

        $tax = config('cart.tax')/100;
        // ?? assigns 0 if session()->get('coupon')['discount'] is empty
        $discount = session()->get('coupon')['discount'] ?? 0;
        $newSubtotal = (Cart::subtotal()-$discount);
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal + $newTax;
        
        // here we are returning the collection so that it's bit cleaner to retrieve them later
        // we are converting array to collection by prepending it with word 'collect'
        return collect([
            'tax'=>$tax,
            'discount'=>$discount,
            'newSubtotal'=>$newSubtotal,
            'newTax'=>$newTax,
            'newTotal'=>$newTotal
        ]); 

        // or we can simply return an array like following code but then
        // the way of fetching the values would be different
        // return [
        //     'tax'=>$tax,
        //     'discount'=>$discount,
        //     'newSubtotal'=>$newSubtotal,
        //     'newTax'=>$newTax,
        //     'newTotal'=>$newTotal
        // ]; 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!Cart::instance('default')->count()) {
            return redirect('/');
        }

        // calculate the new variables discount, newSubtotal etc

        // old way of doing
        // $tax = config('cart.tax')/100;
        // // ?? assigns 0 if session()->get('coupon')['discount'] is empty
        // $discount = session()->get('coupon')['discount'] ?? 0;
        // $newSubtotal = (Cart::subtotal()-$discount);
        // $newTax = $newSubtotal * $tax;
        // $newTotal = $newSubtotal + $newTax;

        // return view('checkout')->with([
        //     'discount'=>$discount,
        //     'newSubtotal'=>$newSubtotal,
        //     'newTax'=>$newTax,
        //     'newTotal'=>$newTotal
        // ]);


        // new way of doing using private method getNewValues()
        
        return view('checkout')->with([
            'discount'=>$this->getNewValues()->get('discount'),
            'newSubtotal'=>$this->getNewValues()->get('newSubtotal'),
            'newTax'=>$this->getNewValues()->get('newTax'),
            'newTotal'=>$this->getNewValues()->get('newTotal')
        ]);

        // if we get array then we would fetch the values like this
        // dd($this->getNewValues());
        // return view('checkout')->with([
        //     'discount'=>$this->getNewValues()['discount'],
        //     'newSubtotal'=>$this->getNewValues()['newSubtotal'],
        //     'newTax'=>$this->getNewValues()['newTax'],
        //     'newTotal'=>$this->getNewValues()['newTotal']
        // ]);

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
        //
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
    public function destroy($id)
    {
        //
    }
}
