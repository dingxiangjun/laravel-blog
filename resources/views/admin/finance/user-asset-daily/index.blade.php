@extends('layouts.admin.application')
@section('title', '用户资产日报')

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
        <input type="text" class="form-control" placeholder="用户ID" name="user_id" value="{{ Request::input('user_id') }}">
    </div>

    <button class="btn btn-primary" type="submit">查询</button>
    <button class="btn btn-default" type="button" id="export-flow">导出</button>
</form>

<table class="table table-striped table-condensed m-t">
    <thead>
        <tr>
            <th>日期</th>
            <th>用户ID</th>
            <th>余额</th>
            <th>冻结</th>
            <th>当日加款</th>
            <th>累计加款</th>
            <th>当日提现</th>
            <th>累计提现</th>
            <th>当日消费</th>
            <th>累计消费</th>
            <th>当日从平台退款</th>
            <th>累计从平台退款</th>
            <th>当日成交次数</th>
            <th>累计成交次数</th>
            <th>当日用户成交</th>
            <th>累计用户成交</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataList as $data)
            <tr>
                <td>{{ $data->date }}</td>
                <td>{{ $data->user_id }}</td>
                <td>{{ $data->balance + 0 }}</td>
                <td>{{ $data->frozen + 0 }}</td>
                <td>{{ $data->recharge + 0 }}</td>
                <td>{{ $data->total_recharge + 0 }}</td>
                <td>{{ $data->withdraw + 0 }}</td>
                <td>{{ $data->total_withdraw + 0 }}</td>
                <td>{{ $data->consume + 0 }}</td>
                <td>{{ $data->total_consume + 0 }}</td>
                <td>{{ $data->refund + 0 }}</td>
                <td>{{ $data->total_refund + 0 }}</td>
                <td>{{ $data->expend + 0 }}</td>
                <td>{{ $data->total_expend + 0 }}</td>
                <td>{{ $data->income + 0 }}</td>
                <td>{{ $data->total_income + 0 }}</td>
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

$('#export-flow').click(function () {
    var url = "{{ route('admin.finance.user-asset-daily.export') }}?" + $('#data-form').serialize();
    window.location.href = url;
});
</script>
@endsection
