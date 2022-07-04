@extends('layouts.main-layout')

@section('title','Главная')

@section('content')

<div class="container">

<div class="money mt-3" style="display: flex;">
  <h3>Вы внесли {{$money}} грн</h3>
  <a href="{{route('form')}}" style="margin-left: 15px;" class="btn btn-info">Внести деньги</a>
</div>

<div class="errors mb-3 mt-3">
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
      </ul>
    </div>
  @endif
</div>

<table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">Название</th>
      <th scope="col">Цена</th>
      <th scope="col">Количество</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  	@foreach($products as $product)
    <tr>
      <td>{{$product->title}}</td>
      <td>{{$product->price}} грн</td>
      <td>{{$product->quantity}} шт</td>
      @if(($product->quantity) == 0)
      	<td>В автомате нет данного товара</td>
      @else
      	<td><a class="btn btn-primary" href="{{route('buy',$product->id)}}">Купить</a></td>
      @endif
    </tr>
    @endforeach
  </tbody>
</table>

  @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
  @endif

<a class="btn btn-warning" href="{{route('surplus')}}">Забрать сдачу</a>
  
</div>
@endsection