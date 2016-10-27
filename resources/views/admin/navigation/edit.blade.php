@extends('admin._layouts.default')

@section('content')

    <div class="container">
        <h2>Edit list details</h2>
        <form class="form-horizontal" action="/admin/navigation/{{$post->id}}/update" method="post" role="form">
            {{csrf_field()}}

            <div class="form-group{{ $errors->has('link_name') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="link_name" value="{{$post->title}}" class="form-control" id="name" placeholder="" disabled>
                    @if ($errors->has('link_name'))<span class="text-red"><strong>{{ $errors->first('link_name') }}</strong></span>@endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('links_to') ? ' has-error' : '' }}">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="links_to" value="{{$post->checkLink()}}" class="form-control" id="name" placeholder="">
                    @if ($errors->has('links_to'))<span class="text-red"><strong>{{ $errors->first('links_to') }}</strong></span>@endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                </div>
            </div>

        </form>
    </div>

@endsection