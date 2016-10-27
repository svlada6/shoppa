@extends('admin._layouts.default')

@section('page_header')
	<h1>
    	Coffee.com Dashboard
    	<small>Control panel</small>
    </h1>
@endsection

@section('breadcrumb')
    <li class="active">Dashboard</li>
@endsection

@section('content')


<div style="border:solid 1px #ddd; border-radius:4px 4px 0 0;">

  <!-- Nav tabs -->
  @include('admin.dashboard.nav')

  @include('admin.dashboard.index_part', ['line_chart'=>'line-chart4', 'revenue_chart'=>'revenue-chart4'])
 
@endsection

@section('scripts')

<script type ="text/javascript">
    $(function() {
        $('#myTabs a').click(function (e) {
            $(this).tab('show');
          });
    });
    
</script>
@endsection