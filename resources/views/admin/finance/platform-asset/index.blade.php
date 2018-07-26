@extends('layouts.admin.application')
@section('title', '平台实时资产')

@section('content')
    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>平台实时资产</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive" style="margin-top: 10px;">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>类目</th>
                                        <th>金额</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>平台资金</td>
                                        <td>{{ $platformAsset->amount + 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>平台托管资金</td>
                                        <td>{{ $platformAsset->managed + 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>用户总余额</td>
                                        <td>{{ $platformAsset->balance + 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>用户总冻结</td>
                                        <td>{{ $platformAsset->frozen + 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>累计用户加款</td>
                                        <td>{{ $platformAsset->total_recharge + 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>累计用户提现</td>
                                        <td>{{ $platformAsset->total_withdraw + 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>累计扣款用户款</td>
                                        <td>{{ $platformAsset->total_consume + 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>累计退款给用户</td>
                                        <td>{{ $platformAsset->total_refund + 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td>累计用户成交次数</td>
                                        <td>{{ $platformAsset->total_trade_quantity }}</td>
                                    </tr>
                                    <tr>
                                        <td>累计用户成交金额</td>
                                        <td>{{ $platformAsset->total_trade_amount + 0 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">平台总资产实时对账</div>
                            <div class="panel-body">
                                <p>外部统计 = 累计用户加款 - 累计用户提现</p>
                                <p>
                                    计算：
                                    {{ $platformAsset->total_recharge + 0 }} - {{ $platformAsset->total_withdraw + 0 }} =
                                    {{ $platformAsset->total_recharge - $platformAsset->total_withdraw }}
                                </p>

                                <hr class="layui-bg-orange">
                                <p>内部统计 = 平台资金 + 平台托管资金 + 用户总余额 + 用户总冻结</p>
                                <p>
                                    计算：
                                    {{ $platformAsset->amount + 0 }} + {{ $platformAsset->managed + 0 }} + {{ $platformAsset->balance + 0 }} + {{ $platformAsset->frozen + 0 }} =
                                    {{ $platformAsset->amount + $platformAsset->managed + $platformAsset->balance + $platformAsset->frozen }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
