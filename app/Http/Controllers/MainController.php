<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\money;

class MainController extends Controller
{
    public function index(){

        $products = product::all();
        $money = money::first();

        $coin = $money->coin / 100;
        $banknote = $money->banknote;

        $money  = $banknote + $coin;

        return view('index',['money'=>$money, 'products' => $products]);
    }

    public function form(){

        return view('form');
    }

    public function store(Request $request){

       $validate = $request->validate([
            'banknote' => 'integer',
            'coin' => 'integer',
        ]);

       $data = money::first();

       $coin = $data->coin + $request->coin;
       $banknote = $data->banknote + $request->banknote;

       money::first()->update(['coin'=>$coin,'banknote'=>$banknote]);

       return redirect('/');
    
    }

    public function surplus()
    {

        $money = money::first();

        $coin = $money->coin / 100;
        $banknote = $money->banknote;

        $money  = $banknote + $coin;

        money::first()->update(['coin'=> 0 , 'banknote' => 0]);

        return redirect('/')->with('message', 'Ваша сдача '.$money. ' грн');

    }


    public function buy($id){

        $money = money::first();
        $coin = $money->coin / 100;
        $banknote = $money->banknote;
        $money  = $banknote + $coin;

        $data = product::where('id',$id)->first();
        $price = $data->price;

        if($money<$price){
            return redirect('/')->withErrors(['msg'=>'У вас недостаточно средств']);
        }

        $NewMoney = $money - $price;
        money::first()->update(['banknote'=> $NewMoney]);

        // при покупке товра, количество данного товра в автомате уменьшаеться на 1
        $quantity = product::where('id',$id)->decrement('quantity');

        return redirect('/')->with('message', 'Заберите ваш '.$data->title);

    }
}
