{{--<div class="btn-group pull-right" style="margin-right: 10px">--}}
{{--<a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#filter-modal"><i class="fa fa-filter"></i>&nbsp;&nbsp;{{ trans('admin.filter') }}</a>--}}
{{--<a href="{!! $action !!}" class="btn btn-sm btn-facebook"><i class="fa fa-undo"></i>&nbsp;&nbsp;{{ trans('admin.reset') }}</a>--}}
{{--</div>--}}

{{--<div class="modal fade" id="filter-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
{{--<div class="modal-dialog" role="document">--}}
{{--<div class="modal-content">--}}
{{--<div class="modal-header">--}}
{{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--<span aria-hidden="true">&times;</span>--}}
{{--<span class="sr-only">Close</span>--}}
{{--</button>--}}
{{--<h4 class="modal-title" id="myModalLabel">{{ trans('admin.filter') }}</h4>--}}
{{--</div>--}}
<form class="form-inline" action="{!! $action !!}" method="get" style="margin-bottom: 0.5em" pjax-container>
    {{--<div class="modal-body">--}}
    <div class="form">
    <div class="form-group">
        <label for="">搜索:</label>&nbsp;&nbsp;
        @foreach($filters as $filter)
            <div class="input-group">
            {!! $filter->render() !!}
            </div>
        @endforeach
    </div>
    {{--</div>--}}
    {{--<div class="modal-footer">--}}
        &nbsp;
        <button type="submit" class="btn btn-sm btn-primary submit">{{ trans('admin.submit') }}</button>
        &nbsp;
        <button type="reset" class="btn btn-sm btn-warning">{{ trans('admin.reset') }}</button>
    </div>
    {{--</div>--}}

</form>
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}