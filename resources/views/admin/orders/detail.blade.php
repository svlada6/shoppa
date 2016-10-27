<!-- Modal -->
<div class="modal modal-detail fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Order Details</h4>
            </div>
            <div class="modal-body">

                <label>Order ID</label>
                <span>{!! $item['stripe_id'] !!}</span>
                <div class="clear"></div>

                <label>User name</label>
                <span>{!! $item['user_name'] !!}</span>
                <div class="clear"></div>

                <label>Plan name</label>
                <span>{!! $item['name'] !!}</span>
                <div class="clear"></div>

                <label>Packages</label>
                <br />
                @if(count($item->collections) > 0)
                    @foreach($item->collections as $c)
                        <span>{!! $c->name !!}</span>
                        <div class="clear"></div>
                    @endforeach
                @endif

                <label>Products</label>
                <br />
                @if(count($item->products) > 0)
                    @foreach($item->products as $p)
                        @if($p->pivot->collection == 0)
                            <span>{!! $p->name !!}</span>
                            <div class="clear"></div>
                        @endif
                    @endforeach
                @endif

                <label>Price</label>
                <span>{!! $item['price'] !!}</span>
                <div class="clear"></div>

                <label>Total Price</label>
                <span>{!! $item['subtotal'] !!}</span>
                <div class="clear"></div>

                <label>Status</label>
                <span>@if($item['delivered']){!! "Delivered" !!}@else{!! "Not delivered" !!}@endif</span>
                <div class="clear"></div>

                <label>Date</label>
                <span>{{ date( 'F j, Y', strtotime($item['created_at'])) }}</span>
                <div class="clear"></div>

                <hr />

                <p><label>Shipping info</label></p>

                <label>First name</label>
                <span>{!! $item['shipping_first_name'] !!}</span>
                <div class="clear"></div>

                <label>Last name</label>
                <span>{!! $item['shipping_last_name'] !!}</span>
                <div class="clear"></div>

                <label>Company</label>
                <span>{!! $item['shipping_company'] !!}</span>
                <div class="clear"></div>

                <label>Address 1</label>
                <span>{!! $item['shipping_address_1'] !!}</span>
                <div class="clear"></div>

                <label>Address 2</label>
                <span>{!! $item['shipping_address_2'] !!}</span>
                <div class="clear"></div>

                <label>City</label>
                <span>{!! $item['shipping_city'] !!}</span>
                <div class="clear"></div>

                <label>State</label>
                <span>{!! $item['shipping_state_name'] !!}</span>
                <div class="clear"></div>

                <label>Postal</label>
                <span>{!! $item['shipping_postal'] !!}</span>
                <div class="clear"></div>

                <hr />

                <p><label>Billing info</label></p>

                <label>First name</label>
                <span>{!! $item['billing_first_name'] !!}</span>
                <div class="clear"></div>

                <label>Last name</label>
                <span>{!! $item['billing_last_name'] !!}</span>
                <div class="clear"></div>

                <label>Company</label>
                <span>{!! $item['billing_company'] !!}</span>
                <div class="clear"></div>

                <label>Address 1</label>
                <span>{!! $item['billing_address_1'] !!}</span>
                <div class="clear"></div>

                <label>Address 2</label>
                <span>{!! $item['billing_address_2'] !!}</span>
                <div class="clear"></div>

                <label>City</label>
                <span>{!! $item['billing_city'] !!}</span>
                <div class="clear"></div>

                <label>State</label>
                <span>{!! $item['billing_state_name'] !!}</span>
                <div class="clear"></div>

                <label>Postal</label>
                <span>{!! $item['billing_postal'] !!}</span>
                <div class="clear"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal" id="cancel-delete">Close</button>
            </div>
        </div>
    </div>
</div>