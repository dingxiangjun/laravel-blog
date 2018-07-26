@extends('layouts.admin.application')
@section('title','角色管理')

@section('css')
    <link href="/vendor/hplus/css/plugins/iCheck/custom.css" rel="stylesheet">
@endsection

@section('content')
    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>角色列表</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form role="form" class="form-inline">
                            <div class="form-group">
                                <select class="form-control" name="account">
                                    <option>选项 1</option>
                                    <option>选项 2</option>
                                    <option>选项 3</option>
                                    <option>选项 4</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail2" class="sr-only">用户名</label>
                                <input type="email" placeholder="请输入用户名" id="exampleInputEmail2" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword2" class="sr-only">密码</label>
                                <input type="password" placeholder="请输入密码" id="exampleInputPassword2"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">登录</button>
                            </div>
                            <div class="form-group" style="float: right">
                                <a class="btn btn-primary add-permission" href="{{route('admin.rbac.role.create')}}">添加角色</a>
                            </div>
                        </form>
                        <div class="table-responsive" style="margin-top: 10px;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>角色名</th>
                                    <th>创建日期</th>
                                    <th>更新日期</th>
                                    <th width="180">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($roles as $role)
                                    <tr data-id="{{$role->id}}">
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->created_at}}</td>
                                        <td>{{$role->updated_at}}</td>
                                        <td class="project-actions">
                                            <a href="javascipt:void(0)"
                                               data-show="{{route('admin.rbac.role.show',$role->id)}}"
                                               class="btn btn-sm btn-info show-permission"><i class="fa fa-folder"></i>
                                                查看 </a>
                                            <a href="{{route('admin.rbac.role.edit',$role->id)}}"
                                               class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil"></i> 编辑
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $roles->appends(Request::all())->links() }}

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="add-edit-game-box" style="display: none;padding: 10px">
        <div class="ibox-content" style="border: none;">
            <form class="form-horizontal layui-form" id="data-form">

            </form>
        </div>
    </div>
@endsection
@section('js')

    <!-- 自定义js -->
    <script src="/vendor/hplus/js/content.js?v=1.0.0"></script>

    <!-- iCheck -->
    <script src="/vendor/hplus/js/plugins/iCheck/icheck.min.js"></script>

    <script>
        //我们强烈推荐你在代码最外层把需要用到的模块先加载
        layui.use(['layer', 'form', 'element', 'upload'], function () {
            var layer = layui.layer, form = layui.form, element = layui.element
            layer.config({
                skin: 'demo-class'
            })

            $('.show-permission').click(function () {
                layer.open({
                    shade: 0.3,
                    type: 1,
                    title: '查看权限',
                    area: ['800px', '700px'],
                    closeBtn: 1,
                    shift: 4,
                    moveType: 2,
                    shadeClose: false,
                    content: $('.add-edit-game-box')
                });
                $('#data-form').attr('action', $(this).attr('data-show'));
                $.get($('#data-form').attr('action'), function (data) {
                        $('#data-form').html(data || '无数据');
                    }
                );

            })

        });

    </script>

@endsection
