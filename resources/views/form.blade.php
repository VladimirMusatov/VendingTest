@extends('layouts.main-layout')

@section('title','Внести валюту')

@section('content')

<div class="container">

<div class="errors mt-3">
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

<div class="card mt-3" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Внесите необходимую сумму</h5>
    <form action="{{route('store')}}">
      @csrf
      <div class="mb-3">
        <label class="form-label">Вставьте купюру</label>
        <input value="0" name="banknote" type="text" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Вставьте копейки</label>
        <input value="0" name="coin" type="text" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Внести сумму</button>
    </form>

  </div>
</div>

</div>
@endsection