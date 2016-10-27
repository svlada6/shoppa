@extends('admin._layouts.default')

@section('page_header')
    <h1>
        @if( $mode == 'edit' )
            Edit Email
        @else
            New Email
        @endif
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">
        @if( $mode == 'edit' )
            Edit Email
        @else
            New Email
        @endif
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
        <div class="col-xs-12">
            <!-- interactive chart -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">                            
                        {{$mode == 'edit'? 'Edit email' : 'Create email'}}
                    </h3>
                </div>                    
                @if($mode == 'edit')
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content" >
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">List of available variables</h4>
                        </div>
                       
                        <div class="modal-body">
                            
                              @foreach($variables as $var)
                                 <p>{{$var->name}}</p>
                              @endforeach
                      
                        </div>
                      
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>

                    </div>
                </div>
                      <div class="modal fade" id="myModal_preview" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content" >
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Template preview</h4>
                        </div>
                        <div class="modal-body">
                            <i><b>Email subject</b></i><br>
                            <span style="" id="subject_content"></span>
                            <hr>
                            <span id="dialog_content"></span>
                      
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>

                    </div>
                </div>
                <div id='variables_dialog' style='display:none;'>
            
                    @foreach($variables as $var)
                     {{$var->name}}
                    @endforeach
                </div>
                @endif
                        <form class="form-horizontal" method="post" action='{{ $mode =='edit' ? url('admin/emails/update/'.$id) : url('admin/emails/create/') }}'>
                            {!! csrf_field() !!}                      
                            <div class="box-body">
                   
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="name" value="{{ $mode == 'edit' ? $name : old('name') }}" />
                                    @if ($errors->has('name'))
                                        <span class="text-red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>                          
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="description" value="{{ $mode == 'edit' ? $name : old('description') }}" />
                                    @if ($errors->has('description'))
                                        <span class="text-red">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Subject</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="subject" value="{{ $mode == 'edit' ? $name : old('subject') }}" />
                                    @if ($errors->has('subject'))
                                        <span class="text-red">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label class="col-sm-2 control-label">Content</label>
                                <div class="col-sm-10">
                                     <textarea id="editor1" name="content" rows="10" cols="80">
                                                 {{$mode == 'edit' ? $content : old('content')}}
                                     </textarea>
                                    @if ($errors->has('content'))
                                        <span class="text-red">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
               
                                @if($mode =='edit')
                                  <a  id='variables' href="javascript:void(0)">View list of emails variables you can use <a>
                                @endif
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                
                                <a href="{{ url('admin/emails') }}" class="btn btn-default pull-left " style="margin-right: 3px" >Back to Templates List</a>
                                @if($mode == 'edit')
                                     <button type="button" id="preview_mail" style="margin-right: 3px" class="btn btn-info pull-left"  />Preview</button>
                                 @endif
                                <input type="submit" class="btn btn-info pull-right" name="submit" value="{{ $mode == 'edit' ? 'Update' : 'Create' }}" />
                                @if($mode == 'edit')
                                  <button type="button" id="send_mail" style="margin-right: 3px" class="btn btn-info pull-right"  />Send test mail</button>
                                @endif

                        </form>

                        @if($mode == 'edit')
                            <form id='email_form' class="form-horizontal" method="post" action='{{url('admin/emails/sendTestEmail/'.$id)}}'>
                                  {!! csrf_field() !!}
                            </form>
                        @endif
                  </div><!-- /.box-footer -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
 
@endsection

@section('scripts')
<script>
    $('#variables').click(function(){
        
        $('#myModal').modal('show');
    });
    
    $('#send_mail').click(function(){
        
        $('#email_form').submit();
    });

    $('#preview_mail').click(function(){
        
        var contents = $('#editor1').val();
        var subject = $('#subject_input').val();

        $('#dialog_content').html(contents);
        $('#subject_content').html(subject);

        $('#myModal_preview').modal('show');
       
  
    });
    
      
</script>
@endsection