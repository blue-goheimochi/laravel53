@extends('layouts.master')

@section('pageTitle', 'トピック投稿')
@section('pageDescription', 'トピック投稿ページです')
@section('pageId', 'topic-new')

@section('container')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <form action="{{ route('new-topic') }}" method="POST" class="form-signin">
        {!! csrf_field() !!}
        <label for="title" class="sr-only">タイトル</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control" placeholder="タイトル" autofocus>
        @if ($errors->has('title'))
        <div class="alert alert-danger" role="alert">{{ $errors->first('title') }}</div>
        @endif
        <div class="body-wrap">
          <label for="body" class="sr-only">本文</label>
          <textarea class="form-control" rows="5" id="body" name="body" placeholder="本文">{{ old('body') }}</textarea>
          @if ($errors->has('body'))
          <div class="alert alert-danger" role="alert">{{ $errors->first('body') }}</div>
          @endif
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">投稿する</button>
      </form>
    </div>
  </div>
</div>
@endsection
