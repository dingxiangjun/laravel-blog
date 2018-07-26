@extends('layouts.admin.application')
@section('title', '结算账号管理')

@section('content')
<form class="form-inline">
    <div class="form-group">
        <label for="user-id">用户ID：</label>
        <input type="text" class="form-control" id="user-id" name="user_id" value="{{ Request::input('user_id') }}">
    </div>
    &nbsp;
    <div class="form-group">
        <label for="bank-card-no">银行卡号：</label>
        <input type="bank_card_no" class="form-control" id="bank-card-no" name="bank_card_no" value="{{ Request::input('bank_card_no') }}">
    </div>

    <button type="submit" class="btn btn-primary">查询</button>
    &nbsp;
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" id="add-new">新增</button>
</form>

<table class="table table-striped table-condensed m-t">
    <tr>
        <th>用户ID</th>
        <th>银行名</th>
        <th>银行卡号</th>
        <th>状态</th>
        <th>创建时间</th>
        <th>最后更新</th>
        <th style="width: 150px">操作</th>
    </tr>
    @foreach ($dataList as $data)
        <tr>
            <td>{{ $data->user_id }}</td>
            <td>{{ $data->bank }}</td>
            <td>{{ $data->bank_card_no }}</td>
            <td>{{ $userTradingAccountStatus[$data->status] }}</td>
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->updated_at }}</td>
            <td>
                <button class="btn btn-info btn-xs destroy" data-url="{{ route('admin.finance.trading-account.destroy', $data->id) }}">删除</button>
            </td>
        </tr>
    @endforeach
</table>

{{ $dataList->appends(Request::all())->links() }}

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">新增</h4>
            </div>
            <div class="modal-body">
                <form id="data-form">
                    <div class="form-group">
                        <label for="user-id">用户ID</label>
                        <input type="text" class="form-control" id="form-user-id">
                    </div>
                    <div class="form-group">
                        <label for="bank">银行</label>
                        <input type="text" class="form-control" id="form-bank" placeholder="开户行及支行名称">
                    </div>
                    <div class="form-group">
                        <label for="bank-card-no">银行卡号</label>
                        <input type="text" class="form-control" id="form-bank-card-no">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submit-data-form">提交</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
function initialize() {
    $('#form-user-id').val('');
    $('#form-bank').val('');
    $('#form-bank-card-no').val('');
}

// 新增
$('#add-new').click(function () {
    initialize();
    $('#data-form').attr('action', "{{ route('admin.finance.trading-account.store') }}");
});

// 提交
$('#submit-data-form').click(function () {
    var load = layer.load(0, {shade: 0.2});

    $.ajax({
        url: $('#data-form').attr('action'),
        type: 'POST',
        dataType: 'json',
        data: {
            user_id: $('#form-user-id').val(),
            bank: $('#form-bank').val(),
            bank_card_no: $('#form-bank-card-no').val()
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
                window.location.reload();
            } else {
                layer.alert(data.message, {icon: 5});
            }
        }
    });
});

// 删除
$('.destroy').click(function () {
    var url = $(this).data('url');

    layer.confirm('确定删除', function () {
        var loading = layer.load(0, {shade: 0.2});

        $.post(url, {
            '_method': 'DELETE'
        }, function (data) {
            layer.close(loading);

            if (data.status == 1) {
                window.location.reload();
            } else {
                layer.alert(data.message, {icon: 5});
            }
        });
    });
});
</script>
@endsection
