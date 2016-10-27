@extends('site._layouts.default')

@section('content')
<section class="costrain-form center"><!-- login section -->
 <form method="post" action="{{url('testemonials/'.Auth::user()->id)}}" >
     {!! csrf_field() !!}
      <div class="form-box"><!-- form box -->
                 <h3>Testemonial</h3>
                 <div class="page-header">
			@if (session('status'))
			<div id="order_success" class="alert alert-block {{ session('status') == 'success' ? 'alert-success' : 'alert-danger' }}">
                        <button data-dismiss="alert" class="close" type="button">×</button>
                          {{ session('message') }}
	         </div>
                          @endif
                    <div class="input-line"><!-- input line -->
                        <div class="half {{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body">Content</label>
                            <textarea  name="body" >
                                {{ $data->first()  ? $data[0]->body : '' }}
                            </textarea>
                             @if ($errors->has('body'))
                                <span class="help-block">
                                    <strong class="error">{{ $errors->first('body') }}</strong>
                                </span>
                             @endif
                     </div>
                     
                    </div><!-- input line END -->
            
       
        </div><!-- form box END -->
        <button type="submit" class="main-action" href="#">Save</button>
<form>
</section>
@endsection