<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>运营后台 - 登录</title>
    <link rel="stylesheet" href="/vendor/layui/css/layui.css">
    <link rel="stylesheet" href="/admins/css/login.css">
</head>
<style>
    #captcha-img {
        margin-top: 5px;
        text-align: right;
    }
    .submit:hover{
        background-color: #FF7C6F;
    }
</style>
<body>
<div class="login">
    <div class="login-warp">
        <div class="login-container">
            <div class="logo"><img src=""></div>
            <div class="container">
                <div class="warp">
                    <div class="content">
                        <div class="title">
                            <h3>运营管理中心</h3>
                            <span class="txt"></span>
                        </div>
                        <form method="POST" action="{{ url('/admin/login') }}" class="layui-form">
                            {{ csrf_field() }}
                            <div class="layui-form-item">
                                <input type="text" name="name" required="" lay-verify="required" placeholder="请输入账号"
                                       value="{{ old('name') }}" autocomplete="off"
                                       class="layui-input layui-form-danger input-text">
                                <i class="layui-icon icon">&#xe612;</i>
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                            <div class="layui-form-item ">
                                <input type="password" name="password" required="" lay-verify="required"
                                       placeholder="请输入密码" value="{{ old('password') }}" autocomplete="off"
                                       class="layui-input layui-form-danger input-text">
                                <i class="layui-icon icon"> &#x1005;</i>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                            <div class="layui-form-item" style="width: 150px;float: left">
                                <input type="text" name="captcha" required="" lay-verify="required" placeholder="请输入验证码"
                                       autocomplete="off" class="layui-input layui-form-danger input-text">
                                <i class="layui-icon icon"> &#x1005;</i>
                            </div>
                            <dd id="captcha-img">
                                <img src="{{captcha_src()}}" alt="" style="cursor: pointer;"
                                     onclick="this.src='{{captcha_src()}}'+ Math.random();">
                            </dd>
                            @if ($errors->has('captcha'))
                                <dt class="error" style="clear: both;display: inline; float: left">
                                    <label>{{ $errors->first('captcha') }}</label>
                                </dt>
                            @endif
                            <div class="layui-form-item">
                                <button class="submit" lay-submit lay-filter="formDemo" style="width: 100%">登 录</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="/vendor/layui/layui.js"></script>
<script src="/admins/js/demo-rtl.js"></script>
</html>