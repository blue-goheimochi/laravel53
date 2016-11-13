@extends('layouts.master')

@section('pageTitle', 'パスワード再設定')
@section('pageDescription', 'パスワード再設定ページです')
@section('pageId', 'password-forgot')

@section('container')
<div class="container">
  <div class="form-wrap">
    <form action="{{ route('password-forgot') }}" method="POST">
      {!! csrf_field() !!}
      <h2 class="form-signin-heading">パスワード再設定</h2>
      <p class="description">
        入力したメールアドレス宛にパスワード再発行ページをお送りいたします。
      </p>
      @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
      @endif
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
      <button class="btn btn-lg btn-primary btn-block btn-submit" type="submit">送信する</button>
    </form>
  </div>
</div>
@endsection