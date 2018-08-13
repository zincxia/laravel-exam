<div class="box">
    <div class="box-header">

        <h3 class="box-title"></h3>
        <div>
            <div class="pull-left">
                {{--{!! $grid->renderFilter() !!}--}}
                {!! $grid->renderHeaderTools() !!}
            </div>
            <div class="pull-right">
                {!! $grid->renderExportButton() !!}
                {!! $grid->renderImportButton() !!}
                {{--{!! $grid->renderImportButton() !!}--}}
                {!! $grid->renderCreateButton() !!}
            </div>
        </div>

        <div class="pull-right">
            {!! $grid->renderFilter() !!}
        </div>

    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
            <tr>
                @foreach($grid->columns() as $column)
                    <th>{{$column->getLabel()}}{!! $column->sorter() !!}</th>
                @endforeach
            </tr>

            @foreach($grid->rows() as $row)
                <tr {!! $row->getRowAttributes() !!}>
                    @foreach($grid->columnNames as $name)
                        <td {!! $row->getColumnAttributes($name) !!}>
                            {!! $row->column($name) !!}
                        </td>
                    @endforeach
                </tr>
            @endforeach

            {!! $grid->renderFooter() !!}

        </table>
    </div>
    <div class="box-footer clearfix">
        {!! $grid->paginator() !!}
    </div>
    <!-- /.box-body -->
</div>
