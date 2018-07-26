@extends('layouts.admin.application')
@section('title','角色管理')

@section('css')
    <link href="/vendor/hplus/css/plugins/iCheck/custom.css" rel="stylesheet">
    <style>
        .permission-role {
            position: absolute;
            top: 0%;
            left: 0%;
            display: block;
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
            background: rgb(255, 255, 255);
            border: 0px;
            opacity: 0;
        }

        .layui-unselect {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>编辑角色</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal layui-form" action="{{route('admin.rbac.role.update',$role->id)}}" id="form">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">角色名称</label>

                                <div class="col-sm-10">
                                    <input type="text" lay-verify="required" value="{{$role->name}}" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">权限</label>
                                <div class="col-sm-10">
                                    <div class="ibox float-e-margins">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="col-md-1 text-center">模块</th>
                                                <th class="col-md-10 text-center">权限</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($datas as $key => $data)
                                                    <tr>
                                                        <td>{{$data['group_name']}}</td>
                                                        <td>
                                                            @foreach($data['items'] as $value)
                                                                <div class="col-md-2">
                                                                    <div class="i-checks">
                                                                        <label>
                                                                            <input type="checkbox" name="permissions[]" value="{{$value['id']}}" {{in_array($value['id'],$permissionsArr) ? 'checked' : ''}} style="position: absolute; opacity: 0;">
                                                                            <ins class="iCheck-helper permission-role"></ins>
                                                                            {{$value['slug']}}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                @empty

                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" lay-submit="" lay-filter="submit">确定</button>
                                    <button class="btn btn-white">取消</button>
                                </div>
                            </div>
                        </form>
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

        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });

        //我们强烈推荐你在代码最外层把需要用到的模块先加载
        layui.use(['layer', 'form', 'element', 'upload'], function () {
            var layer = layui.layer, form = layui.form, element = layui.element
            layer.config({
                skin: 'demo-class'
            })

            // 查看游戏
            form.on('submit(submit)', function (data) {
                var data = $('#form').serialize();

                var load = layer.load(0, {shade: 0.2});
                $.ajax({
                    url: $('#form').attr('action'),
                    type: 'PUT',
                    dataType: 'json',
                    data: data,
                    error: function (data) {
                        layer.close(load);
                        var errors = data.responseJSON.errors;
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
