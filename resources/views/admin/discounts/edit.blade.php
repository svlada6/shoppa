@extends('admin._layouts.default')

@section('page_header')
    <h1>
            Edit Discount
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">
            Edit Discount
    </li>
@endsection

@section('content')<div class="row">
    <div class="col-xs-12">
        <!-- interactive chart -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                        Edit
                </h3>
            </div>
            <!-- form start -->
            <form class="form-horizontal" method="post" action="/admin/discount/{{$discount->id}}/update">
                {!! csrf_field() !!}
                <div class="box-body">
                    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label">Discount code</label>
                        <div class="col-sm-10">
                            <input type="text" name="code" value="{{$discount->code}}" class="form-control" id="code" placeholder="Discount code" required>
                            @if ($errors->has('code'))<span class="text-red"><strong>{{ $errors->first('code') }}</strong></span>@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('limit') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label">Limit</label>
                        <div class="col-sm-10">
                            <input type="radio" name="limit" value="0" {{$discount->limit == 0 ? 'checked' : ''}}> No limit<br>
                            <input type="radio" name="limit" value="1" {{$discount->limit == 1 ? 'checked' : ''}}> Limit
                            @if ($errors->has('limit'))<span class="text-red"><strong>{{ $errors->first('limit') }}</strong></span>@endif
                        </div>
                    </div>

                    {{--<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label">Generate code</label>
                        <div class="col-sm-10">
                            <a href="#" id="generateCode" class="btn btn-default pull-left">Generate Code</a>
                            @if ($errors->has('name'))<span class="text-red"><strong>{{ $errors->first('name') }}</strong></span>@endif
                        </div>
                    </div>--}}

                    <div class="form-group{{ $errors->has('discount_type') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label">Discount type</label>
                        <div class="col-sm-10">
                            {!! Form::select('discount_type', $discountTypes, $discount->discount_type, ['class' => 'form-control']) !!}
                            @if ($errors->has('discount_type'))<span class="text-red"><strong>{{ $errors->first('discount_type') }}</strong></span>@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('take') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="text" name="take" id="take" value="{{$discount->take}}" class="form-control">
                            @if ($errors->has('take'))<span class="text-red"><strong>{{ $errors->first('take') }}</strong></span>@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('discount_extra') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            {!! Form::select('discount_extra', $extraConditions, $discount->discount_extra, ['class' => 'form-control']) !!}
                            @if ($errors->has('discount_extra'))<span class="text-red"><strong>{{ $errors->first('discount_extra') }}</strong></span>@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('discount_begins') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label">Discount begins</label>
                        <div class="col-sm-10">
                            <input type="text" id="datepickerBegins" name="discount_begins" value="{{$discount->discount_begins->format('m/d/Y')}}" class="form-control">
                            @if ($errors->has('discount_begins'))<span class="text-red"><strong>{{ $errors->first('discount_begins') }}</strong></span>@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('discount_ends') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label">Discount ends</label>
                        <div class="col-sm-10">
{{--                            {{dd($discount)}}--}}
                            <input type="text" id="datepickerEnds" name="discount_ends" value="{{$discount->discount_end_app}}" class="form-control" autocomplete="off">
                            @if ($errors->has('discount_ends'))<span class="text-red"><strong>{{ $errors->first('discount_ends') }}</strong></span>@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('never_expires') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label">Newer expires</label>
                        <div class="col-sm-10">
                            <input type="checkbox" id="neverExpires" name="never_expires" value="{{$discount->never_expires}}" {{$discount->never_expires == 1 ? 'checked' : ''}}>
                            @if ($errors->has('never_expires'))<span class="text-red"><strong>{{ $errors->first('never_expires') }}</strong></span>@endif
                        </div>
                    </div>

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ url('admin/discount') }}" class="btn btn-default">Back to Discount List</a>
                    <input type="submit" class="btn btn-info pull-right" name="submit" value="Update" />
                </div><!-- /.box-footer -->
            </form>
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection

@section('scripts')
    <script>
        $( document ).ready(function() {
            $('#generateCode').on('click', function(){
                $.ajax({
                    url: "/admin/discount/getCode",
                    type: "POST",
                    success: function (data) {
                        $('#code').val(data);
                    }
                });
            });

            $( "#datepickerBegins" ).datepicker({ dateFormat: 'yy-mm-dd' });
            $( "#datepickerEnds" ).datepicker({ dateFormat: 'yy-mm-dd' });

            $('#datepickerEnds').on('focus', function(){
                var ends = $(this);
                if(ends.val()){
                    $('#neverExpires').attr('disabled', 'disabled');
                }
            });

            $('#datepickerEnds').on('blur', function(){
                var ends = $(this);
                if(ends.val()){
                    $('#neverExpires').attr('disabled', 'disabled');
                }else{
                    $('#neverExpires').removeAttr("disabled");
                }
            });

            $('#neverExpires').change(function(){
                if($(this).is(":checked")){
                    $('#datepickerEnds').attr('disabled', 'disabled').val('');

                }else{
                    $('#datepickerEnds').removeAttr("disabled");
                }
            });

        });
    </script>

@endsection