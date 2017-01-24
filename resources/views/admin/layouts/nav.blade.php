<nav class="navbar navbar-fixed-top navbar-light bg-faded">
  <div class="navbar-header">
    <a class="navbar-brand navbar-toggleable-xs" href="/admin">Sample App 管理画面</a>
    <button class="navbar-toggler hidden-sm-up pull-xs-right" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">&#9776;</button>
  </div>
  <div class="navbar-menu clearfix collapse navbar-toggleable-xs pull-sm-right pull-md-right pull-lg-right pull-xl-right pull-xs-left" id="navbar-menu">
    <ul class="nav navbar-nav">
      @if (Auth::guard('admin')->guest())
      @else
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.logout') }}">ログアウト</a>
      </li>
      @endif
    </ul>
  </div>
</nav>