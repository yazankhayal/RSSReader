<?php

namespace App\Http\Controllers;

use App\Rss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use FeedReader;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function rss()
    {
        $items = Rss::where("user_id",Auth::user()->id)->paginate(5);
        return view('rss',compact('items'));
    }

    public function details($id = null)
    {
        $item = Rss::where("user_id",Auth::user()->id)
            ->where("id",$id)
            ->first();
        if($item == null){
            return redirect()->route('rss');
        }
        $f = FeedReader::read($item->name);
        $items = $f->get_items();
        return view('details',compact('item','items'));
    }

    public function save_rss(Request $request)
    {
        $validator = Validator::make($request->all(),$this->Rules());
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }
        else{
            $save = new Rss();
            $save->name = $request->name;
            $save->user_id = Auth::user()->id;
            $save->save();
            return redirect()->route('rss');
        }
    }

    public function Rules(){
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $x = [
            'name' => 'required|string|max:255',
        ];
        return $x;
    }
}
