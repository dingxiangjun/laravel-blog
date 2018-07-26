@extends('layouts.admin.application')
@section('title', '用户资金流水')

@section('content')
<form class="form-inline" id="data-form">
    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        <input type="text" class="form-control" id="start-time" name="start_time" value="{{ Request::input('start_time') }}" placeholder="开始时间" readonly>
    </div>

    <div class="input-group">
        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
        <input type="text" class="form-control" id="end-time" name="end_time" value="{{ Request::input('end_time') }}" placeholder="结束时间" readonly>
    </div>

    <div class="form-group">
        <select class="form-control" name="trade_type">
            <option value="">所有类型</option>
            @foreach ($assetTradeType['platform'] as $key => $value)
                <option value="{{ $key }}" {{ $key == Request::input('trade_type') ? 'selected' : '' }}>{{ $key }}. {{ $value }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <select class="form-control" name="trade_subtype">
            <option value="">所有子类型</option>
            @foreach ($assetTradeType['platform_sub'] as $key => $value)
                <option value="{{ $key }}" {{ $key == Request::input('trade_subtype') ? 'selected' : '' }}>{{ $key }}. {{ $value }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="相关单号" name="trade_no" value="{{ Request::input('trade_no') }}">
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="用户ID" name="user_id" value="{{ Request::input('user_id') }}">
    </div>

    <button class="btn btn-primary" type="submit">查询</button>
</form>

<table class="table table-striped table-condensed m-t">
    <thead>
    <tr>
        <th>流水号</th>
        <th>用户</th>
        <th>管理员</th>
        <th>类型</th>
        <th>子类型</th>
        <th>相关单号</th>
        <th>金额</th>
        <th>备注</th>
        <th>余额</th>
        <th>冻结</th>
        <th>累计加款</th>
        <th>累计提现</th>
        <th>累计扣款</th>
        <th>累计退款</th>
        <th>累计支出</th>
        <th>累计收入</th>
        <th>时间</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($dataList as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->user_id }}</td>
                <td>{{ $data->admin_user_id }}</td>
                <td>{{ $assetTradeType['user'][$data->trade_type] ?? $data->trade_type }}</td>
                <td>{{ $assetTradeType['user_sub'][$data->trade_subtype] ?? $data->trade_subtype }}</td>
                <td>{{ $data->trade_no }}</td>
                <td>{{ $data->fee + 0}}</td>
                <td>{{ $data->remark}}</td>
                <td>{{ $data->balance + 0}}</td>
                <td>{{ $data->frozen + 0}}</td>
                <td>{{ $data->total_recharge + 0}}</td>
                <td>{{ $data->total_withdraw + 0}}</td>
                <td>{{ $data->total_consume + 0}}</td>
                <td>{{ $data->total_refund + 0}}</td>
                <td>{{ $data->total_expend + 0}}</td>
                <td>{{ $data->total_income + 0}}</td>
                <td>{{ $data->created_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $dataList->appends(Request::all())->links() }}
@endsection

@section('js')
<script>
var option = {
    language: 'zh-CN',
    format: 'yyyy-mm-dd',
    minView: 2,
    autoclose: true,
    todayBtn: true,
    todayHighlight: true
};

$('#start-time').datetimepicker(option);
$('#end-time').datetimepicker(option);
</script>
@endsection
