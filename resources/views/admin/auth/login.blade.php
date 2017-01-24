@extends('admin.layouts.master')

@section('pageTitle', '管理画面ログイン')
@section('pageDescription', '管理画面ログインページです')
@section('pageId', 'login')

@section('container')
<div class="container">
  <div class="form-wrap">
    <form action="{{ route('admin.login') }}" method="POST">
      {!! csrf_field() !!}
      <h2 class="form-signin-heading">管理画面ログイン</h2>
      @if (count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
        {{ $error }}<br>
        @endforeach
      </div>
      @endif
      @if (session('message'))
      <div class="alert alert-danger" role="alert">{{ session('message') }}</div>
      @endif
      <label for="email" class="sr-only">メールアドレス</label>
      <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="メールアドレス" autofocus>
      <label for="password" class="sr-only">パスワード</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="パスワード">
      <button class="btn btn-lg btn-primary btn-block btn-login" type="submit">ログイン</button>
    </form>
  </div>
</div>
@endsection