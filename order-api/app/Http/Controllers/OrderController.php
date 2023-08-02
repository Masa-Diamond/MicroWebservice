<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function purchase($bookID,Request $request)
    {
        $this->validate($request,[
            'items'=> 'required|integer|min:1'
        ]);
        //dd($request->input('items'));
        $InfoResponse = Http::get('localhost:8000/api/books/'.$bookID);
        if(isset($InfoResponse['id'])){
            if($InfoResponse['items']>0 && $InfoResponse['items']>=$request->input('items')){

                $UpdateRequest = Http::put('http://localhost:8000/api/update/books/'.$bookID,
                [
                    'items' => $InfoResponse['items']-$request->input('items'),
                    'cost' =>  $InfoResponse['cost'],
                    'title'=>  $InfoResponse['title'],
                    'topic'=>  $InfoResponse['topic']
                ]);
                $UpdateRequest = Http::put('http://localhost:8005/api/update/books/'.$bookID,
                    [
                        'items' => $InfoResponse['items']-$request->input('items'),
                        'cost' =>  $InfoResponse['cost'],
                        'title'=>  $InfoResponse['title'],
                        'topic'=>  $InfoResponse['topic']
                    ]);

                if($UpdateRequest->status()==200){

                    $order = new Order();
                    $order->bookID=$InfoResponse['id'];
                    $order->numItems=$request->input('items');
                    $order->total=$InfoResponse['cost']*$request->input('items');

                    $order->save();
                    return response()->json($order);


                }else{
                    dd("Request Failed! Please Try Again");
                }



            }else{
                dd("This Book Is Out Of Stock");
            }
           // dd("inside if");
        }else{
            dd("This Books Does Not Exists");
        }


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
