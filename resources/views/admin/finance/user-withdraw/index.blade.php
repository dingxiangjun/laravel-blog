@extends('layouts.admin.application')
@section('title', '用户提现管理')

@section('content')
<form class="form-inline">
    <div class="form-group">
        <label for="no">提现单号：</label>
        <input type="text" class="form-control" id="no" name="no" value="{{ Request::input('no') }}">
    </div>
    &nbsp;
    <div class="form-group">
        <label for="user-id">用户ID：</label>
        <input type="text" class="form-control" id="user-id" name="user_id" value="{{ Request::input('user_id') }}">
    </div>
    &nbsp;
    <div class="form-group">
        <label for="status">状态：</label>
        <select class="form-control" name="status">
            @foreach ($status as $key => $value)
                <option value="{{ $key }}" {{ $key == Request::input('status') ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
    </div>
    &nbsp;
    <button type="submit" class="btn btn-primary">查询</button>
</form>

<table class="table table-striped table-condensed m-t">
    <tr>
        <th>单号</th>
        <th>用户ID</th>
        <th>金额</th>
        <th>状态</th>
        <th>备注</th>
        <th>创建时间</th>
        <th>最后更新</th>
        <th style="width: 150px">操作</th>
    </tr>
    @foreach ($dataList as $data)
        <tr>
            <td>{{ $data->no }}</td>
            <td>{{ $data->user_id }}</td>
            <td>{{ $data->fee }}</td>
            <td>{{ $status[$data->status] }}</td>
            <td>{{ $data->remark }}</td>
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->updated_at }}</td>
            <td>
                @if ($data->status == 1)
                    <button class="btn btn-success btn-xs complete" data-url="{{ route('admin.finance.user-withdraw.complete', $data->id) }}">完成</button>
                    <button class="btn btn-danger btn-xs refuse" data-url="{{ route('admin.finance.user-withdraw.refuse', $data->id) }}">拒绝</button>
                @else
                    --
                @endif
            </td>
        </tr>
    @endforeach
</table>

{{ $dataList->appends(Request::all())->links() }}
@endsection

@section('js')
<script>
// 完成, 拒绝
$('.complete, .refuse').click(function () {
    var url = $(this).data('url');

    layer.confirm('再次确认', function (data) {
        var loading = layer.load(0, {shade: 0.3});

        $.post(url, function (data) {
            layer.close(loading);

            if (data.status == 1) {
                layer.alert('操作成功', function () {
                    window.location.reload();
                });
            } else {
                layer.alert(data.message, {icon: 5});
            }
        }, 'json');
    });
});

</script>
@endsection
