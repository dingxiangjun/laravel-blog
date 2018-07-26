@extends('layouts.admin.application')
@section('title','日志列表')
@include('log-viewer::_template.style')
@section('content')
    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>日志列表</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-condensed table-hover table-stats">
                                <thead>
                                <tr>
                                    @foreach($headers as $key => $header)
                                        <th class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                                            @if ($key == 'date')
                                                <span class="label label-info">{{ $header }}</span>
                                            @else
                                                <span class="level level-{{ $key }}">
                                {!! log_styler()->icon($key) . ' ' . $header !!}
                            </span>
                                            @endif
                                        </th>
                                    @endforeach
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if ($rows->count() > 0)
                                    @foreach($rows as $date => $row)
                                        <tr>
                                            @foreach($row as $key => $value)
                                                <td class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                                                    @if ($key == 'date')
                                                        <span class="label label-primary">{{ $value }}</span>
                                                    @elseif ($value == 0)
                                                        <span class="level level-empty">{{ $value }}</span>
                                                    @else
                                                        <a href="{{ route('admin.log.log.filter', [$date, $key]) }}">
                                                            <span class="level level-{{ $key }}">{{ $value }}</span>
                                                        </a>
                                                    @endif
                                                </td>
                                            @endforeach
                                            <td class="text-right">
                                                <a href="{{ route('admin.log.log.show', [$date]) }}" class="btn btn-xs btn-info">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                                <a href="{{ route('admin.log.log.download', [$date]) }}" class="btn btn-xs btn-success">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <a href="#delete-log-modal" class="btn btn-xs btn-danger" data-log-date="{{ $date }}">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="11" class="text-center">
                                            <span class="label label-default">{{ trans('log-viewer::general.empty-logs') }}</span>
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        {!! $rows->render() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


{{-- DELETE MODAL --}}
<div id="delete-log-modal" class="modal fade">
    <div class="modal-dialog">
        <form id="delete-log-form" action="{{ route('admin.log.log.destroy') }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="date" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">删除文件</h4>
                </div>
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">删除</button>
                </div>
            </div>
        </form>
    </div>
</div>


@section('js')
    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm  = $('form#delete-log-form'),
                submitBtn      = deleteLogForm.find('button[type=submit]');

            $("a[href=#delete-log-modal]").on('click', function(event) {
                event.preventDefault();
                var date = $(this).data('log-date');
                deleteLogForm.find('input[name=date]').val(date);
                deleteLogModal.find('.modal-body p').html(
                    '你确定要 <span class="label label-danger">删除</span> 这个日志文件 <span class="label label-primary">' + date + '</span> ?'
                );

                deleteLogModal.modal('show');
            });

            deleteLogForm.on('submit', function(event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url:      $(this).attr('action'),
                    type:     $(this).attr('method'),
                    dataType: 'json',
                    data:     $(this).serialize(),
                    success: function(data) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.reload();
                        }
                        else {
                            alert('AJAX ERROR ! Check the console !');
                            console.error(data);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });

            deleteLogModal.on('hidden.bs.modal', function() {
                deleteLogForm.find('input[name=date]').val('');
                deleteLogModal.find('.modal-body p').html('');
            });
        });
    </script>
@endsection
