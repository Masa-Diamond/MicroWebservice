<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
Use Exception;
//use App\User;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllBooks(){
       // dd("test");
        return response()->json(Books::all());
    }
    public function findBook($id){

        // dd("test");
        // dd($number);
        //$book = Books::find($number);
        $book= Books::where('id', $id)->first();
        if($book) {
            $book = json_decode($book);
            return response()->json($book);
        }
        else {
            dd("This Books Does Not Exists");
        }

    }
    public function findBookByTitle($title){
        // dd($title);
        $title=urldecode($title);
        // dd($title);
        $book= Books::where('title', $title)->first();
        if($book) {
            $book = json_decode($book);
            return response()->json($book);
        }
        else {
            dd("This Books Does Not Exists");
        }

    }

    public function update($id,Request $request)
    {

        //dd($request);
        try{

            $this->validate($request,[

                'title'=> 'required',
                'topic'=> 'required',
                'items'=> 'required',
                'cost'=> 'required',
            ]);

            $book= Books::where('id', $id)->first();
            //dd($book);
          //  $book = Books::where('number',$number)->findOrFail($number);
            //$book = Books::query()->findOrFail($number);
            $book->title = $request->input('title');
            $book->topic = $request->input('topic');
            $book->items = $request->input('items');
            $book->cost = $request->input('cost');
            //$book->update($request->all());
            // return response()->json($book,200);
            $book->save();
            return response()->json($book);
        }

        catch(\Illuminate\Database\QueryException $ex){
        dd($ex->getTrace());
    }


        //$book = Books::where('number',$number)->findOrFail();

       // $book = Books::query()->findOrFail($number);
       // $book->update($request->all());
       // return response()->json($book,200);
    }






    public function index()
    {
        //get method all data from database
        $books = Books::all();
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
            'items'=>'required',
            'cost'=>'required'
        ]);

        $book = new Books();
        $book->title= $request->input('title');
        $book->topic= $request->input('topic');
        $book->items= $request->input('items');
        $book->cost= $request->input('cost');

        $book->save();
        return response()->json($book);
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
