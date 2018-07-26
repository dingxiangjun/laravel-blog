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
                                <a class="btn btn-primary add-permission" href="{{route('admin.rbac.adminUser.create')}}">添加用户</a>
                            </div>
                        </form>
                        <div class="table-responsive" style="margin-top: 10px;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>用户名</th>
                                    <th>邮箱</th>
                                    <th>创建日期</th>
                                    <th>更新日期</th>
                                    <th width="180">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr data-id="{{$user->id}}">
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <td>{{$user->updated_at}}</td>
                                        <td>
                                            <a href="{{route('admin.rbac.adminUser.show',$user->id)}}" class="btn btn-sm btn-primary edit-permission"><i class="fa fa-pencil"></i> 查看 </a>
                                            <a href="{{route('admin.rbac.adminUser.edit',$user->id)}}" class="btn btn-sm btn-primary edit-permission"><i class="fa fa-pencil"></i> 编辑 </a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $users->appends(Request::all())->links() }}

                    </div>
                </div>
            </div>

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

        });

    </script>

@endsection
