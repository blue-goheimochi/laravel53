@extends('layouts.master')

@section('pageTitle', 'パスワード再発行')
@section('pageDescription', 'パスワード再発行ページです')
@section('pageId', 'password-reset')

@section('container')
<div class="container">
  <div class="form-wrap">
    <form action="{{ route('password-reset') }}" method="POST">
      {!! csrf_field() !!}
      <input type="hidden" name="token" value="{{ $token }}">
      <h2 class="form-signin-heading">パスワード再発行</h2>
      <p class="description">
        ご登録いただいているメールアドレスと新しいパスワードを入力してください。
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
      <label class="input-label" for="email">メールアドレス</label>
      <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="メールアドレス" autofocus>
      <label class="input-label" for="password">新しいパスワード</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="6文字以上で入力">
      <label class="input-label" for="password_confirmation">パスワード確認</label>
      <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="上記と同じ内容で入力">
      <button class="btn btn-lg btn-primary btn-block btn-submit" type="submit">再発行する</button>
    </form>
  </div>
</div>
@endsection