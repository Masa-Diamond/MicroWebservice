<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get method all data from database
        $books = Product::all();
        return response()->json($books);
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
        //post data to database from user
        $this->validate($request,[
            'title'=>'required',
            'topic'=>'required',
            'items in stock'=>'required',
            'cost'=>'required'
        ]);

        $product = new Product();
        $product->title= $request->input('title');
        $product->topic= $request->input('topic');
        $product->items_in_stock= $request->input('items in stock');
        $product->cost= $request->input('cost');

        $product->save();
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //give 1 item from product table
        $book = Product::find($id);
        return response()->json($book);
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
        //update by id
        $this->validate($request,[
            'title'=>'required',
            'topic'=>'required',
            'items in stock'=>'required',
            'cost'=>'required'
        ]);

        $product =Product::find($id);
        $product->title= $request->input('title');
        $product->topic= $request->input('topic');
        $product->items_in_stock= $request->input('items in stock');
        $product->cost= $request->input('cost');

        $product->save();
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete by id
    }
}
