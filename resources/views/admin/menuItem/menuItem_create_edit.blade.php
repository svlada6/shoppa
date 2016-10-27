@extends('admin._layouts.default')

@section('page_header')
    <h1>
        @if( $mode == 'edit' )
            Edit Menu Item
        @else
            New Menu Item
        @endif
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">
        @if( $mode == 'edit' )
            Edit Menu Item
        @else
            New Menu Item
        @endif
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!-- interactive chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        @if( $mode == 'edit' )
                            Edit {{ $data->caption }} Plan
                        @else
                            Create New Menu Item
                        @endif
                    </h3>
                </div>
                <!-- form start -->
                <form class="form-horizontal" method="post" action='{{ $mode == 'edit' ? url("admin/menu-item/$data->id/edit") : "" }}' >
                    {!! csrf_field() !!}
                    <div class="box-body">

                        <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Caption</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="caption" value="{{ $mode == 'edit' ? $data->caption : old('caption') }}"  />
                                @if ($errors->has('caption'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('caption') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('menuGroup') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Menu Group</label>
                            <div class="col-sm-10">
                                @if($mode == 'edit')
                                    {!! Form::select('menu_id', $menus, $data->menu_id, ['class' => 'form-control']) !!}
                                    @else
                                    {!! Form::select('menu_id', $menus, [], ['class' => 'form-control']) !!}
                                @endif
                                @if ($errors->has('menuGroup'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('menuGroup') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Url</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="url" value="{{ $mode == 'edit' ? $data->url : old('url') }}"  />
                                @if ($errors->has('url'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ url('admin/menu-items') }}" class="btn btn-default">Back to Menu Items</a>
                        <input type="submit" class="btn btn-info pull-right" name="submit" value="{{ $mode == 'edit' ? 'Update' : 'Create' }}" />
                    </div><!-- /.box-footer -->
                </form>
                @if($mode == 'edit')
                    <ul id="sortable">Main menu links:
                        @foreach($sortableMainMenu as $mainMenu)
                            <li  id="item-{{$mainMenu->id}}" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{$mainMenu->caption}}
                            LINKS TO: {{$mainMenu->url}}
                            </li>
                        @endforeach
                    </ul>

                    <ul id=""> Footer links:
                        @foreach($sortableFooterMenu as $footerMenu)
                            <li  id="item-{{$footerMenu->id}}" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{$footerMenu->caption}}
                                LINKS TO: {{$footerMenu->url}}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('scripts')
    <script>
        $(function() {
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();
        });

        $('ul').sortable({
            axis: 'y',
            update: function (event, ui) {
                var data = $(this).sortable('serialize');

                // POST to server using $.post or $.ajax
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: '/admin/menu-items/sort'
                });
            }
        });

    </script>
@endsection