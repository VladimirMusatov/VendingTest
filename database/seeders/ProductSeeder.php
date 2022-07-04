<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'title'=>'Товар 1',
            'price' =>'10',
            'quantity'=>'10',
            ]);

        DB::table('products')->insert([
            'title'=>'Товар 2',
            'price' =>'20',
            'quantity'=>'5',
            ]);

        DB::table('products')->insert([
            'title'=>'Товар 3',
            'price' =>'30',
            'quantity'=>'3',
            ]);

        DB::table('products')->insert([
            'title'=>'Товар 4',
            'price' =>'40',
            'quantity'=>'20',
            ]);

        DB::table('products')->insert([
            'title'=>'Товар 5',
            'price' =>'50',
            'quantity'=>'15',
            ]);
    }
}
