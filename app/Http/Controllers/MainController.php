<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\money;

class MainController extends Controller
{
    public function index(){

        //Получение данных с базы
        $products = product::all();
        $money = money::first();

        //Получение монет
        $coin = $money->coin / 100;
        //Получение купюр
        $banknote = $money->banknote;
        //Общая сумма
        $money  = $banknote + $coin;

        return view('index',['money'=>$money, 'products' => $products]);
    }

    public function form(){

        return view('form');
    }


    //Функция сохранения денег в базу данных
    public function store(Request $request){

       $validate = $request->validate([
            'banknote' => 'integer',
            'coin' => 'integer',
        ]);

       //Получаем количество денег в автомате
       $data = money::first();

       //Получени монет
       $coin = $data->coin + $request->coin;
       //Получени купюр
       $banknote = $data->banknote + $request->banknote;

       //Обновление данных
       money::first()->update(['coin'=>$coin,'banknote'=>$banknote]);

       return redirect('/');
    
    }

    //Выдача сдачи
    public function surplus()
    {
        //Получение данных с базы
        $money = money::first();    

        //Получение монет
        $coin = $money->coin / 100;
        //Получение купюр
        $banknote = $money->banknote;

        //Сумма
        $money  = $banknote + $coin;

        //Обновление данных в базе
        money::first()->update(['coin'=> 0 , 'banknote' => 0]);

        return redirect('/')->with('message', 'Ваша сдача '.$money. ' грн');

    }


    //Покупка товара
    public function buy($id){

        //Получение данных с базы
        $money = money::first();
        //Получение монет
        $coin = $money->coin / 100;
        //Получние купюр
        $banknote = $money->banknote;
        //Cумма
        $money  = $banknote + $coin;

        //Запрос к базе данных с целью получения требуемого товара
        $data = product::where('id',$id)->first();
        //Получение цены требуемого товара
        $price = $data->price;

        //Если у пользователя мало денег для покупки
        if($money<$price){
            return redirect('/')->withErrors(['msg'=>'У вас недостаточно средств']);
        }

        //Заносим оставшиеся деньги пользователя в базу данных
        $NewMoney = $money - $price;
        money::first()->update(['banknote'=> $NewMoney]);

        // при покупке товра, количество данного товра в автомате уменьшаеться на 1
        $quantity = product::where('id',$id)->decrement('quantity');

        return redirect('/')->with('message', 'Заберите ваш '.$data->title);

    }
}
