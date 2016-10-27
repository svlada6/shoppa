@inject('request', 'App\Http\Requests\DashboardRequest')

<ul class="nav nav-tabs" id="myTabs" role="tablist">
    <li role="presentation" class="text-center {{$request->is('admin/dashboard') ? 'active' : ''}}" style ="width:20%;">
        <a href="{{ url('/admin/dashboard') }}">
            <span class="text-gray lead text-bold"> Today </span><br />
            <h2 class="text-black">${!! $orders_info['today']['price'] !!}</h2><br />
            <span class="text-black"> {!! $orders_info['today']['number'] !!} @if($orders_info['today']['number'] == 1){!! "order" !!}@else{!! "orders" !!}@endif </span><br />
        </a>
    </li>
    <li role="presentation" class="text-center {{$request->is('admin/dashboard_yesterday') ? 'active' : ''}}" style ="width:20%;">
        <a href="{{ url('/admin/dashboard_yesterday') }}">
            <span class="text-gray lead text-bold"> Yesterday </span><br />
            <h2 class="text-black">${!! $orders_info['yesterday']['price'] !!}</h2><br />
            <span class="text-black"> {!! $orders_info['yesterday']['number'] !!} @if($orders_info['yesterday']['number'] == 1){!! "order" !!}@else{!! "orders" !!}@endif</span><br />
        </a>
    </li>
    <li role="presentation" class="text-center {{$request->is('admin/dashboard_7Days') ? 'active' : ''}}" style ="width:20%;">
        <a href="{{ url('/admin/dashboard_7Days') }}">
            <span class="text-gray lead text-bold"> Last 7 Days </span><br />
            <h2 class="text-black">${!! $orders_info['week']['price'] !!}</h2><br />
            <span class="text-black"> {!! $orders_info['week']['number'] !!} @if($orders_info['week']['number'] == 1){!! "order" !!}@else{!! "orders" !!}@endif </span><br />
        </a>
    </li>
    <li role="presentation" class="text-center {{$request->is('admin/dashboard_30Days') ? 'active' : ''}}" style ="width:20%;">
        <a href="{{ url('/admin/dashboard_30Days') }}">
            <span class="text-gray lead text-bold"> Last 30 Days </span><br />
            <h2 class="text-black">${!! $orders_info['month']['price'] !!}</h2><br />
            <span class="text-black"> {!! $orders_info['month']['number'] !!} @if($orders_info['month']['number'] == 1){!! "order" !!}@else{!! "orders" !!}@endif </span><br />
        </a>
    </li>
    <li role="presentation" class="text-center {{$request->is('admin/dashboard_all_time') ? 'active' : ''}}" style ="width:20%;">
        <a href="{{ url('/admin/dashboard_all_time') }}">
            <span class="text-gray lead text-bold"> All Time </span><br />
            <h2 class="text-black">${!! $orders_info['all']['price'] !!}</h2><br />
            <span class="text-black"> {!! $orders_info['all']['number'] !!} @if($orders_info['all']['number'] == 1){!! "order" !!}@else{!! "orders" !!}@endif  </span><br />
        </a>
    </li>
</ul>

