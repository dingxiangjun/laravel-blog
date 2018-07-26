@extends('layouts.admin.application')
@section('title', '平台资金流水')

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
    <button class="btn btn-default" type="button" id="export-flow">导出</button>
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
        <th>平台资金</th>
        <th>平台托管</th>
        <th>用户余额</th>
        <th>用户冻结</th>
        <th>累计用户加款</th>
        <th>累计用户提现</th>
        <th>累计用户消费</th>
        <th>累计退款给用户</th>
        <th>累计用户成交次数</th>
        <th>累计用户成交金额</th>
        <th>时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($dataList as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->user_id }}</td>
                <td>{{ $data->admin_user_id }}</td>
                <td>{{ $assetTradeType['platform'][$data->trade_type] ?? $data->trade_type }}</td>
                <td>{{ $assetTradeType['platform_sub'][$data->trade_subtype] ?? $data->trade_subtype }}</td>
                <td>{{ $data->trade_no }}</td>
                <td>{{ $data->fee + 0}}</td>
                <td>{{ $data->remark}}</td>
                <td>{{ $data->amount + 0}}</td>
                <td>{{ $data->managed + 0}}</td>
                <td>{{ $data->balance + 0}}</td>
                <td>{{ $data->frozen + 0}}</td>
                <td>{{ $data->total_recharge + 0}}</td>
                <td>{{ $data->total_withdraw + 0}}</td>
                <td>{{ $data->total_consume + 0}}</td>
                <td>{{ $data->total_refund + 0}}</td>
                <td>{{ $data->total_trade_quantity }}</td>
                <td>{{ $data->total_trade_amount + 0}}</td>
                <td>{{ $data->created_at}}</td>
                <td><button class="btn btn-info btn-xs order" data-url="{{ route('admin.finance.platform-amount-flow.order', $data->id) }}">查看</button></td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $dataList->appends(Request::all())->links() }}

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">相关单据信息</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
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
    var url = "{{ route('admin.finance.platform-amount-flow.export') }}?" + $('#data-form').serialize();
    window.location.href = url;
});

// 查看
$('.order').click(function () {
    $.get($(this).data('url'), function (data) {
        if (data.status == 1) {
            var html = '<table class="table table-bordered">';

            for (var i = 0; i < data.content.length; i++) {
                html += '<tr>';
                html += '<td>' + data.content[i].column + '</td>';
                html += '<td>' + data.content[i].value + '</td>';
                html += '</tr>';
            }

            html += '</table>';

            $('#myModal .modal-body').html(html);
            $('#myModal').modal('show');
        } else {
            layer.alert(data.message);
        }
    }, 'json')
});
</script>
@endsection
