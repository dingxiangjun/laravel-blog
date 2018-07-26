@extends('layouts.admin.application')
@section('title','日志图表')
@section('css')
    <link href="/vendor/log-viewer/bootstrap-datetimepicker.min.css" rel="stylesheet">
    @include('log-viewer::_template.style')
@endsection
@section('content')

    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>日志图表</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="form-group" style="float: right">
                            <a class="btn btn-primary" href="{{route('admin.log.log.index')}}">日志列表</a>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <canvas id="stats-doughnut-chart" height="300"></canvas>
                            </div>
                            <div class="col-md-9">
                                <section class="box-body">
                                    <div class="row">
                                        @foreach($percents as $level => $item)
                                            <div class="col-md-4">
                                                <div class="info-box level level-{{ $level }} {{ $item['count'] === 0 ? 'level-empty' : '' }}">
                                <span class="info-box-icon">
                                    {!! log_styler()->icon($level) !!}
                                </span>

                                                    <div class="info-box-content">
                                                        <span class="info-box-text">{{ $item['name'] }}</span>
                                                        <span class="info-box-number">
                                        {{ $item['count'] }} entries - {!! $item['percent'] !!} %
                                    </span>
                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: {{ $item['percent'] }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </section>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('js')
    <script src="/vendor/log-viewer/bootstrap.min.js"></script>
    <script src="/vendor/log-viewer/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.min.js"></script>
    <script src="/vendor/log-viewer/bootstrap-datetimepicker.min.js"></script>
    <script>
        Chart.defaults.global.responsive = true;
        Chart.defaults.global.scaleFontFamily = "'Source Sans Pro'";
        Chart.defaults.global.animationEasing = "easeOutQuart";
        $(function () {
            new Chart($('canvas#stats-doughnut-chart'), {
                type: 'doughnut',
                data: {!! $chartData !!},
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        });
    </script>
@endsection
