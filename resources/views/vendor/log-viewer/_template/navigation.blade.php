<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ route('admin.log.log.dash') }}" class="navbar-brand">
                <i class="fa fa-fw fa-book"></i> LogViewer
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li class="{{ Route::is('admin.log.log.dash') ? 'active' : '' }}">
                    <a href="{{ route('admin.log.log.dash') }}">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </a>
                </li>
                <li class="{{ Route::is('admin.log.log.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.log.log.index') }}">
                        <i class="fa fa-archive"></i> Logs
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
