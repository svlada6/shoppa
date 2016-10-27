@extends('admin._layouts.default')

@section('page_header')
    <h1>
        General settings
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">

        General settings

    </li>
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="page-header">
			@if (session('status'))
	        <div id="order_success" class="alert alert-block {{ session('status') == 'success' ? 'alert-success' : 'alert-danger' }}">
	            <button data-dismiss="alert" class="close" type="button">×</button>
	            {{ session('message') }}
	        </div>
	        @endif
			
		</div>
	</div>
</div>
    <div class="row">
        <div class="col-xs-12">
            <!-- interactive chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                      General Settings
                    </h3>
                </div>
                <!-- form start -->
                <form class="form-horizontal" method="post" action='{{url('admin/settings/update')}}'>
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name" value="{{ (isset($data['name'])) ? $data['name']: old('name') }}"  />
                                @if ($errors->has('name'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Homepage Title</label>&nbsp &nbsp  &nbsp <span id="homepage_title">{{ (isset($data['homepage_title'])) ? strlen($data['homepage_title']):0 }}</span><span> of 70 characters used<span>
                            <div class="col-sm-10">
                                <input class="form-control" id="homepage_title_input" type="text" name="homepage_title" value="{{ (isset($data['homepage_title'])) ? $data['homepage_title']: old('homepage_title') }}"  />
                                @if ($errors->has('homepage_title'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('homepage_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('home_page_meta_description') ? ' has-error' : '' }}">

                            <label class="col-sm-2 control-label">Homepage meta description</label>&nbsp &nbsp  &nbsp<span id="meta_desc">{{ (isset($data['home_page_meta_description'])) ? strlen($data['home_page_meta_description']):0 }}</span><span> of 160 characters used<span>
                            <div class="col-sm-10">
                               <textarea maxlength='160' class="form-control"  id="home_page_meta_description" name="home_page_meta_description"  />{{ (isset($data['home_page_meta_description'])) ? $data['home_page_meta_description']:old('home_page_meta_description')}}</textarea>
                                @if ($errors->has('home_page_meta_description'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('home_page_meta_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('account_email') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Account email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="account_email" value="{{ (isset($data['account_email'])) ? $data['account_email']: old('account_email') }}"  />
                                @if ($errors->has('account_email'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('account_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('customer_email') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Customer email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="customer_email" value="{{ (isset($data['customer_email'])) ? $data['customer_email']: old('customer_email') }}"  />
                                @if ($errors->has('customer_email'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('customer_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group{{ $errors->has('legal_name_of_bussines') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Legal name of bussines</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="legal_name_of_bussines" value="{{ (isset($data['legal_name_of_bussines'])) ? $data['legal_name_of_bussines']: old('legal_name_of_bussines') }}"  />
                                @if ($errors->has('legal_name_of_bussines'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('legal_name_of_bussines') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                          <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="phone" value="{{ (isset($data['phone'])) ? $data['phone']: old('phone') }}"  />
                                @if ($errors->has('phone'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                          <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Street</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="street" value="{{ (isset($data['street'])) ? $data['street']: old('street') }}"  />
                                @if ($errors->has('street'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                          <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">City</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="city" value="{{ (isset($data['city'])) ? $data['city']: old('city') }}"  />
                                @if ($errors->has('city'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('postal') ? ' has-error' : '' }}">
                            <label class="col-sm-2 control-label">Postal</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="postal" value="{{ (isset($data['postal'])) ? $data['postal']: old('postal') }}"  />
                                @if ($errors->has('postal'))
                                    <span class="text-red">
                                        <strong>{{ $errors->first('postal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
               
                       <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                             <label class="col-sm-2 control-label">Country</label>
                              <div class="col-sm-4">
                              
                                 {{ Form::select('country',$countries, (isset($data['country']))?$data['country']:230 ,['class' => 'form-control','id'=>'country']) }}

                                    @if ($errors->has('country'))
                                        <span class="text-red">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                            </div>
                               <div class="col-sm-6" id="state" <?php if(isset($data['country']) && $data['country'] != 230) echo 'style="display:none"' ?>
                                <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            
                                        {{ Form::select('state', $state, (isset($data['state'])) ? $data['state']:0 ,['class' => 'form-control']) }}
                                        @if ($errors->has('state'))
                                            <span class="text-red">
                                                <strong>{{ $errors->first('state') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                        </div>
 
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{ url('admin/accounts') }}" class="btn btn-default">Back Accounts List</a>
                        <input type="submit" class="btn btn-info pull-right" name="submit" value="Update" />
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('scripts')
    <script>
        $('#home_page_meta_description').keyup(function(){

            len = $(this).val().length;

            $('#meta_desc').html(len);

        });

        $('#homepage_title_input').keyup(function(){

            len = $(this).val().length;

            $('#homepage_title').html(len);

        });

        $('#country').change(function(){

            country =  $(this).val();

            if(country == 230)
            {
                $('#state').show();
            }
            else
            {
                $('#state').hide();
            }

        });
    </script>
@endsection