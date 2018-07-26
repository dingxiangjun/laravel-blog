<div class="form-group">
    <label class="col-sm-1 control-label" style="padding-left: 0px">角色名</label>
    <div class="col-sm-11">
        <input type="text" class="form-control" value="{{$role->name}}" lay-verify="required" name="name">
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="form-group">
    <label class="col-sm-1 control-label">权限</label>
    <div class="col-sm-11">
        <div class="ibox float-e-margins">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-xs-2 text-center">模块</th>
                    <th class="col-xs-10 text-center">权限</th>
                </tr>
                </thead>
                <tbody class="data-list">
                @forelse($datas as $key => $data)
                    <tr>
                        <td>{{$data['group_name']}}</td>
                        <td>
                            @foreach($data['items'] as $value)
                                <div class="col-md-2">
                                    <div class="i-checks">
                                        <label>
                                            <input type="checkbox" checked name="permissions[]"  style="position: absolute; opacity: 0;">
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

