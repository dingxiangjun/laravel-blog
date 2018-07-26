@extends('layouts.admin.application')
@section('title', '平台资产日报')

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

    <button class="btn btn-primary" type="submit">查询</button>
    <button class="btn btn-default" type="button" id="export-flow">导出</button>
</form>

<table class="table table-striped table-condensed m-t">
    <thead>
        <tr>
            <th>日期</th>
            <th>平台资金</th>
            <th>平台托管</th>
            <th>用户余额</th>
            <th>用户冻结</th>
            <th>当日用户加款</th>
            <th>累计用户加款</th>
            <th>当日用户提现</th>
            <th>累计用户提现</th>
            <th>当日用户消费</th>
            <th>累计用户消费</th>
            <th>当日退款给用户</th>
            <th>累计退款给用户</th>
            <th>当日用户成交次数</th>
            <th>累计用户成交次数</th>
            <th>当日用户成交</th>
            <th>累计用户成交</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataList as $data)
            <tr>
                <td class="date">{{ $data->date }}</td>
                <td class="amount">{{ $data->amount + 0 }}</td>
                <td class="managed">{{ $data->managed + 0 }}</td>
                <td class="balance">{{ $data->balance + 0 }}</td>
                <td class="frozen">{{ $data->frozen + 0 }}</td>
                <td>{{ $data->recharge + 0 }}</td>
                <td class="total-recharge">{{ $data->total_recharge + 0 }}</td>
                <td>{{ $data->withdraw + 0 }}</td>
                <td class="total-withdraw">{{ $data->total_withdraw + 0 }}</td>
                <td>{{ $data->consume + 0 }}</td>
                <td>{{ $data->total_consume + 0 }}</td>
                <td>{{ $data->refund + 0 }}</td>
                <td>{{ $data->total_refund + 0 }}</td>
                <td>{{ $data->trade_quantity }}</td>
                <td>{{ $data->total_trade_quantity }}</td>
                <td>{{ $data->trade_amount + 0 }}</td>
                <td>{{ $data->total_trade_amount + 0 }}</td>
                <td><button class="btn btn-info btn-xs account-checking" type="button">对账</button></td>
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
    var url = "{{ route('admin.finance.platform-asset-daily.export') }}?" + $('#data-form').serialize();
    window.location.href = url;
});

// 对账
$('.account-checking').click(function () {
    var $td           = $(this).parent();
    var date          = $td.siblings('.date').text();
    var amount        = parseFloat($td.siblings('.amount').text());
    var managed       = parseFloat($td.siblings('.managed').text());
    var balance       = parseFloat($td.siblings('.balance').text());
    var frozen        = parseFloat($td.siblings('.frozen').text());
    var totalRecharge = parseFloat($td.siblings('.total-recharge').text());
    var totalWithdraw = parseFloat($td.siblings('.total-withdraw').text());

    var content = '<p>左右相等就是对的</p><p>';
    content += '计算（左）：' + totalRecharge + ' - ' + totalWithdraw + ' = ' + (totalRecharge * 10000 - totalWithdraw * 10000) / 10000 + '</p>';
    content += '<p>计算（右）：'
            + amount
            + ' + '
            + managed
            + ' + '
            + balance
            + ' + '
            + frozen
            + ' = '
            + (amount * 10000 + managed * 10000 + balance * 10000 + frozen * 10000) / 10000;
            + '</p>';
    content += '<p style="color:#aaa">公式: 累计用户加款 - 累计用户提现 = 平台资金 + 平台托管 + 用户余额 + 用户冻结</p>';

    var accountCheckingAlert = layer.alert(content, {title:'日期: ' + date});
    layer.style(accountCheckingAlert, {width:'730px'});
});
</script>
@endsection
