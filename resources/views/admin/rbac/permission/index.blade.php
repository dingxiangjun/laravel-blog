@extends('layouts.admin.application')
@section('title','权限管理')

@section('css')
    <link href="/vendor/hplus/css/plugins/iCheck/custom.css" rel="stylesheet">
@endsection

@section('content')
    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>权限列表</h5>
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
                                <a class="btn btn-primary add-permission" href="javascript:void(0)">添加权限</a>
                            </div>
                        </form>
                        <div class="table-responsive" style="margin-top: 10px;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>权限名</th>
                                    <th>权限</th>
                                    <th>分组</th>
                                    <th>分组名</th>
                                    <th>创建日期</th>
                                    <th>更新日期</th>
                                    <th width="180">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($permissions as $permission)
                                    <tr data-id="{{$permission->id}}">
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->slug}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->group}}</td>
                                        <td>{{$permission->group_name}}</td>
                                        <td>{{$permission->created_at}}</td>
                                        <td>{{$permission->updated_at}}</td>
                                        <td>
                                            <a href="javascipt:void(0)" class="btn btn-sm btn-primary edit-permission"
                                               data-edit="{{route('admin.rbac.permission.edit',$permission->id)}}"
                                               data-update="{{route('admin.rbac.permission.update',$permission->id)}}"><i
                                                        class="fa fa-pencil"></i> 编辑 </a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $permissions->appends(Request::all())->links() }}

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="add-edit-game-box" style="display: none;padding: 20px">
        <div class="ibox-content">
            <form class="form-horizontal layui-form" id="data-form">
                <div class="form-group">
                    <label class="col-sm-2 control-label">权限</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" lay-verify="required" name="slug">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">权限名</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" lay-verify="required" name="name"> <span
                                class="help-block m-b-none">如：admin.user.index</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">分组</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" lay-verify="required" name="group_name">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">分组名</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" lay-verify="required" name="group"> <span
                                class="help-block m-b-none">如：user</span>
                    </div>
                </div>

                <div class="hr-line-dashed"></div>

                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-primary" lay-submit="" lay-filter="submit">确定</button>
                    </div>
                </div>
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
            $('.add-permission').click(function () {
                layer.open({
                    shade: 0.3,
                    type: 1,
                    title: '添加权限',
                    area: ['600px', '700px'],
                    closeBtn: 1,
                    shift: 4,
                    moveType: 2,
                    shadeClose: false,
                    content: $('.add-edit-game-box')
                });
                $("#data-form input[name='name']").val('')
                $("#data-form input[name='slug']").val('')
                $('#data-form').attr('action', "{{ route('admin.rbac.permission.store') }}").attr('method', 'POST');
            })
            $('.edit-permission').click(function () {
                $('#data-form').attr('action', $(this).attr('data-update')).attr('method', 'PUT')
                layer.open({
                    shade: 0.3,
                    type: 1,
                    title: '编辑权限',
                    area: ['600px', '700px'],
                    closeBtn: 1,
                    shift: 4,
                    moveType: 2,
                    shadeClose: false,
                    content: $('.add-edit-game-box')
                });
                $.ajax({
                    type: 'get',
                    url: $(this).attr('data-edit'),
                    success: function (result) {
                        $("input[name='name']").val(result.data.name)
                        $("input[name='slug']").val(result.data.slug)
                        $("input[name='group_name']").val(result.data.group_name)
                        $("input[name='group']").val(result.data.group)
                    }
                })
            })

            // 查看游戏
            form.on('submit(submit)', function (data) {
                var load = layer.load(0, {shade: 0.2});
                $.ajax({
                    url: $('#data-form').attr('action'),
                    type: $('#data-form').attr('method'),
                    dataType: 'json',
                    data: {
                        name: data.field.name,
                        slug: data.field.slug,
                        group_name: data.field.group_name,
                        group: data.field.group,
                    },
                    error: function (data) {
                        layer.close(load);
                        errors = data.responseJSON.errors;
                        for (key in errors) {
                            layer.alert(errors[key][0], {icon: 5});
                            return false;
                        }
                    },
                    success: function (data) {
                        layer.close(load);
                        if (data.status == 1) {
                            layer.msg(data.message, {icon: 6, time: 1500}, function () {
                                window.location.reload();
                            })
                        } else {
                            layer.alert(data.message, {icon: 5});
                        }
                    }
                });
                return false;
            });
        });

    </script>

@endsection
