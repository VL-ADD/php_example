<!-- /resources/views/post/create.blade.php -->

@extends('welcome')

@section('content')

@include('header')

@guest

<div class="alert alert-danger">
  <p> Пожалуйста авторизуйтесь </p>
</div>

@endguest

@if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif     

<form action="{{ route ('AddPost', [$userId = Auth::user()-> id ])}}"  method = "post">
@csrf
    <div class = "form-group">
        <label for = "heading" > Заголовок поста  </label>
        <input type = "text" name ="heading"  placeholder = "Введите заголовок" id = "heading" class = "form-control" />  
    </div>
    <div class = "form-group">
        <label for = "form_content" > Содержимое </label>
        <textarea  name ="form_content" id = "form_content" class = "form-control"></textarea>
    </div>
    <button type = "submit" name = "send_button" class = "btn btn-success" > Добавить пост </button>
</form>

@endsection