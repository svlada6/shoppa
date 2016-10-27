@extends('admin._layouts.default')

@section('page_header')
    <h1>
        New Navigation
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">
            New Navigation
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <!-- interactive chart -->
            <div class="box box-primary">
                <!-- form start -->

                <form class="form-horizontal" method="post" action="/admin/navigation/create">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Create List Details
                        </h3>
                    </div>

                    {!! csrf_field() !!}
                    <div class="box-body">

                        <div class="form-group{{ $errors->has('titleId') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                {!! Form::select('titleId', $posts, null, ['class' => 'form-control']) !!}
                                @if ($errors->has('titleId'))<span class="text-red"><strong>{{ $errors->first('titleId') }}</strong></span>@endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('links_to') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Links to</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="links_to" value="{{ old('links_to')}}" required />
                                @if ($errors->has('links_to'))<span class="text-red"><strong>{{ $errors->first('links_to') }}</strong></span>@endif
                            </div>
                        </div>

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ url('admin/navigation') }}" class="btn btn-default">Back to Links List</a>
                        <input type="submit" class="btn btn-info pull-right" name="submit" value="Add Navigation Link" />
                    </div><!-- /.box-footer -->
                </form>
                <ul id="sortable">
                    @foreach($sortablePosts as $sortablePost)
                        <li  id="item-{{$sortablePost->id}}" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>{{$sortablePost->title}}</li>
                    @endforeach
                </ul>
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
//                console.log(data);

                // POST to server using $.post or $.ajax
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: '/admin/product/sort'
                });
            }
        });

    </script>
@endsection