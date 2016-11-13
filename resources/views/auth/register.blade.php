@extends('layouts.master')

@section('pageTitle', 'ユーザー登録')
@section('pageDescription', 'ユーザー登録ページです')
@section('pageId', 'register')

@section('container')
<div class="container">
  <div class="form-wrap">
    <form action="{{ route('register') }}" method="POST">
      {{ csrf_field() }}
      <h2 class="form-signin-heading">ユーザー登録</h2>
      <label class="input-label" for="name">ユーザー名</label>
      <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="sample" autofocus>
      @if ($errors->has('name'))
      <div class="alert alert-danger" role="alert">{{ $errors->first('name') }}</div>
      @endif
      <label class="input-label" for="email">メールアドレス</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="sample@test.com" autofocus>
      @if ($errors->has('email'))
      <div class="alert alert-danger" role="alert">{{ $errors->first('email') }}</div>
      @endif
      <label class="input-label" for="password">パスワード</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="6文字以上で入力">
      <label class="input-label" for="password_confirmation">パスワード確認</label>
      <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="上記と同じ内容で入力">
      @if ($errors->has('password'))
      <div class="alert alert-danger" role="alert">{{ $errors->first('password') }}</div>
      @endif
      <button class="btn btn-lg btn-primary btn-block btn-register" type="submit">登録</button>
    </form>
  </div>
</div>
@endsection
