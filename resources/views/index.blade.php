@extends('layouts.master')

@section('pageTitle', 'トップページ')
@section('pageDescription', 'トップページです')
@section('pageId', 'index')

@section('container')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="main">
        <h2>新着トピック</h2>
        <section class="new-topics">
          @forelse($topics as $topic)
          <div class="topic">
            <div class="title"><a href="/topic/{{ $topic->id }}">{{ $topic->title }}</a></div>
            <div class="body">{{ str_limit($topic->body, 200) }}</div>
            <div class="data clearfix">
              <div class="name clearfix"><i class="fa fa-user fa-fw" aria-hidden="true"></i> {{ $topic->user->name }}</div>
              <div class="date"><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i> {{ $topic->created_at }}</div>
            </div>
          </div>
          @empty
          <div class="no-topic"><p>新着トピックがありません</p></div>
          @endforelse
        </section>
      </div>
    </div>
  </div>
</div>
@endsection
