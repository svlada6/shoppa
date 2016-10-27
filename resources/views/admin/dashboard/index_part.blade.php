<!-- Tab panes -->
  <div class="tab-content">
      <div class="tab-pane fade in active" id="home">
          
                        <!-- Main content -->
                  <section class="content">

                      <!-- Main row -->
                      <div class="row">
                          <!-- Left col -->
                          <section class="col-lg-7 connectedSortable">
                              <!-- Custom tabs (Charts with tabs)-->

                              <!-- TABLE: LATEST ORDERS -->
                              <div class="box box-info">
                                  <div class="box-header with-border">
                                      <h3 class="box-title">Latest Orders</h3>
                                      <div class="box-tools pull-right">
                                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                      </div>
                                  </div><!-- /.box-header -->
                                  <div class="box-body">
                                      <div class="table-responsive">
                                          <table class="table no-margin">
                                              <thead>
                                              <tr>
                                                  <th>Order ID</th>
                                                  <th>Item</th>
                                                  <th>Status</th>

                                              </tr>
                                              </thead>
                                              <tbody>

                                              @if(count($orders) > 0)
                                                  @foreach($orders as $order)

                                                  <tr>
                                                      <td><a href="pages/examples/invoice.html">{{ $order['stripe_id'] }}</a></td>
                                                      <td>{{ $order['name'] }}</td>
                                                      <td><span class="label label-success"></span></td>
                                                  </tr>
                                                 
                                                  @endforeach
                                                  @endif
                                                  
                                              </tbody>
                                          </table>
                                      </div><!-- /.table-responsive -->
                                  </div><!-- /.box-body -->
                                  <div class="box-footer clearfix">
                                      {{--<a href="javascript:;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>--}}
                                      <a href="/admin/orders" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                                  </div><!-- /.box-footer -->
                              </div><!-- /.box -->

                          </section><!-- /.Left col -->
                          <!-- right col (We are only adding the ID to make the widgets sortable)-->
                          <section class="col-lg-5 connectedSortable">

                              <!-- PRODUCT LIST -->
                              <div class="box box-primary">
                                  <div class="box-header with-border">
                                      <h3 class="box-title">Top Products</h3>
                                      <div class="box-tools pull-right">
                                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                      </div>
                                  </div><!-- /.box-header -->
                                  <div class="box-body">
                                      <ul class="products-list product-list-in-box">

                                          @if(count($products) > 0)
                                              @foreach($products as $product)
                                              <li class="item">
                                                  <div class="product-img">
                                                      <?php $images = json_decode($product->images, true); ?>
                                                      <img src="{{ asset($images[0]) }}" alt="Product Image">
                                                  </div>
                                                  <div class="product-info">
                                                      <a href="javascript:;" class="product-title"><span class="label label-warning pull-right">${{ $product->total_sales }}</span></a>
                                                      <span class="product-description">
                                                          {{ $product->name }}
                                                      </span>
                                                  </div>
                                              </li><!-- /.item -->

                                              @endforeach
                                          @endif
                                          
                                      </ul>
                                  </div><!-- /.box-body -->
                                  <div class="box-footer text-center">
                                      <a href="/admin/products" class="uppercase">View All Products</a>
                                  </div><!-- /.box-footer -->
                              </div><!-- /.box -->
                              
                  </section><!-- /.content -->
                  
                  </div>
                      </section>
          
      </div>  
  </div>

</div>
