@extends('admin._layouts.default')

@section('page_header')
    <h1>
        New Discount
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">
            Create new Discount
    </li>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                            Create New Discount
                    </h3>
                </div>
                <div class="container">
                <form class="form" method="post" action='/admin/discount/create'>
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <h3>Discount Details:</h3>
                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="code">Discount code</label>
                            <input type="text" name="code" value="{{old('code')}}" class="form-control" id="code" placeholder="Discount code">
                            @if ($errors->has('code'))<span class="text-red"><strong>{{ $errors->first('code') }}</strong></span>@endif

                        </div>

                        <div class="form-group{{ $errors->has('limit') ? ' has-error' : '' }}">
                            <input type="radio" name="limit" value="0" {{old('limit') == 0 ? 'checked' : ''}}> No limit<br>
                            <input type="radio" name="limit" value="1" {{old('limit') == 1 ? 'checked' : ''}}> Limit
                            @if ($errors->has('limit'))<span class="text-red"><strong>{{ $errors->first('limit') }}</strong></span>@endif
                        </div>

                        <div class="form-group">
                            <a href="#" id="generateCode" class="btn btn-default pull-left">Generate Code</a>
                        </div>
                        <br>
                        <hr>
                        <h3>Discount Type:</h3>
                        <div class="form-group{{ $errors->has('discount_type') ? ' has-error' : '' }}">
                            {!! Form::select('discount_type', $discountTypes, old('discount_type'), ['class' => 'form-control']) !!}
                            @if ($errors->has('discount_type'))<span class="text-red"><strong>{{ $errors->first('discount_type') }}</strong></span>@endif
                        </div>

                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="take">Take</label>
                            <input type="text" name="take" id="take" value="{{old('take')}}" class="form-control">
                            @if ($errors->has('take'))<span class="text-red"><strong>{{ $errors->first('take') }}</strong></span>@endif

                        </div>

                        <div class="form-group{{ $errors->has('discount_extra') ? ' has-error' : '' }}">
                            {!! Form::select('discount_extra', $extraConditions, old('discount_extra'), ['class' => 'form-control']) !!}
                            @if ($errors->has('discount_extra'))<span class="text-red"><strong>{{ $errors->first('discount_extra') }}</strong></span>@endif
                        </div>

                            <br>
                        <hr>
                        <h3>Discount Range:</h3>
                        <div class="form-group{{ $errors->has('discount_begins') ? ' has-error' : '' }}">
                            <label for="datepicker">Discount begins</label>
                            <input type="text" id="datepickerBegins" name="discount_begins" value="{{old('discount_begins')}}" class="form-control">
                            @if ($errors->has('discount_begins'))<span class="text-red"><strong>{{ $errors->first('discount_begins') }}</strong></span>@endif

                        </div>

                        <label for="datepicker">Discount ends</label>
                        <input type="text" id="datepickerEnds" name="discount_ends" value="{{old('discount_ends')}}" class="form-control" autocomplete="off">

                        <label for="neverExpires">Never Expires</label>
                        <input type="checkbox" id="neverExpires" name="never_expires" value="1" {{old('never_expires') == 1 ? 'checked' : ''}}>

                    </div>
                    <div class="box-footer">
                        <a href="{{ url('admin/discount') }}" class="btn btn-default">Back to Discount List</a>
                        <input type="submit" class="btn btn-info pull-right" name="submit" value="Add Discount" />
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div>
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
                  $('#datepickerEnds').attr('disabled', 'disabled');
                }else{
                    $('#datepickerEnds').removeAttr("disabled");
                }
            });

        });
    </script>
@endsection