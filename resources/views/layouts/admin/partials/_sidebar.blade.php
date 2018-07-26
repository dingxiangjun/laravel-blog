<li class="{{in_array($currentRouteName,['admin.index.index']) ? 'active' : ''}}">
    <a class="" href="{{route('admin.index.index')}}"><i class="fa fa-columns"></i> <span
                class="nav-label">首页</span></a>
</li>

<li class="{{in_array($route[1],['finance']) ? 'active' : ''}}">
    <a href="#">
        <i class="fa fa-cutlery"></i>
        <span class="nav-label">财务管理</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">

        <li class="{{in_array($route[2],['platform']) ? 'active' : ''}}">
            <a class="" href="{{route('admin.finance.platform.index')}}">平台实时资产</a>
        </li>


        <li class="{{in_array($route[2],['platform-amount-flow']) ? 'active' : ''}}">
            <a class=""
               href="{{route('admin.finance.platform-amount-flow.index')}}">平台资金流水</a>
        </li>

        <li class="{{in_array($route[2],['user-asset']) ? 'active' : ''}}">
            <a class=""
               href="{{route('admin.finance.user-asset.index')}}">用户资产列表</a>
        </li>

        <li class="{{in_array($route[2],['user-amount-flow']) ? 'active' : ''}}">
            <a class=""
               href="{{route('admin.finance.user-amount-flow.index')}}">用户资金流水</a>
        </li>

        <li class="{{in_array($route[2],['user-add-money']) ? 'active' : ''}}">
            <a class=""
               href="{{route('admin.finance.user-add-money.index')}}">用户加款管理</a>
        </li>

        <li class="{{in_array($route[2],['user-withdraw']) ? 'active' : ''}}">
            <a class=""
               href="{{route('admin.finance.user-withdraw.index')}}">用户提现管理</a>
        </li>

        <li class="{{in_array($route[2],['trading-account']) ? 'active' : ''}}">
            <a class=""
               href="{{route('admin.finance.trading-account.index')}}">结算账号管理</a>
        </li>

        <li class="{{in_array($route[2],['platform-asset-daily']) ? 'active' : ''}}">
            <a class="" href="{{route('admin.finance.platform-asset-daily.index')}}">平台实时资产</a>
        </li>

        <li class="{{in_array($route[2],['user-asset-daily']) ? 'active' : ''}}">
            <a class="" href="{{route('admin.finance.user-asset-daily.index')}}">平台资金流水</a>
        </li>
    </ul>
</li>



@hasallroles("超级管理员")
<li class="{{in_array($route[1],['rbac','log']) ? 'active' : ''}}">
    <a href="#">
        <i class="fa fa-cutlery"></i>
        <span class="nav-label">系统管理</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        @can('admin.rbac.adminUser.index')
            <li class="{{in_array($route[2],['adminUser']) ? 'active' : ''}}">
                <a class="" href="{{route('admin.rbac.adminUser.index')}}">用户管理</a>
            </li>
        @endcan
        @can('admin.rbac.role.index')
            <li class="{{in_array($route[2],['role']) ? 'active' : ''}}">
                <a class=""
                   href="{{route('admin.rbac.role.index')}}">角色管理</a>
            </li>
        @endcan
        @can('admin.rbac.permission.index')
            <li class="{{in_array($route[2],['permission']) ? 'active' : ''}}">
                <a class=""
                   href="{{route('admin.rbac.permission.index')}}">权限管理</a>
            </li>
        @endcan

        <li class="{{in_array($route[2],['log']) ? 'active' : ''}}">
            <a class=""
               href="{{route('admin.log.log.dash')}}">日志管理</a>
        </li>
    </ul>
</li>
@endrole
