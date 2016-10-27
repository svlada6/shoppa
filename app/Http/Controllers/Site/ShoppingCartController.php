<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SiteController;
use Cart;

class ShoppingCartController extends Controller
{

    public function postUpdateCart( Request $request )
    {
	    if( $request->ajax() )
	    {
		    Cart::destroy();

		    if( $request->input('type') == 'sample_package' )
		    	$delivery = 'FREE shipping';
		    else
		    	$delivery = $request->input('delivery');

	        Cart::add(
	        	$request->input('id'),
	        	$request->input('name'), 
	        	$request->input('packs'), 
	        	$request->input('price'), 
	        	[
	        		'delivery' 	=> $delivery, 
	        		'type' 		=> $request->input('type'), 
	        	]
	        );

	        $rowid = Cart::content()->first()->rowid;
	        if( $rowid )
	        {
	        	Cart::update($rowid, ['packages' => []]);
	        	Cart::update($rowid, ['products' => []]);
	        }
		}
	}


	public function postAddItemToCart( Request $request )
    {
	    if( $request->ajax() )
	    {
			$rowid = Cart::content()->first()->rowid;
			
			if( $rowid )
			{				
				// Check and count the items already added in the shopping cart
				$total_packages = Cart::content()->first()->packages ? array_sum(array_column(Cart::content()->first()->packages, 'quantity')) : 0;
				$total_products = Cart::content()->first()->products ? array_sum(array_column(Cart::content()->first()->products, 'quantity')) : 0;

				if( $total_products + $total_packages >= Cart::content()->first()->qty )
					return response()->json(
						['status' => 'error', 
						'message' => 'Cart is full with items']
					);

				$quantity = 1;

				switch( $request->input('type') )
				{
					case 'package':						
						if( Cart::content()->first()->packages )
						{
							$packages = Cart::content()->first()->packages;							

							if( array_key_exists($request->input('id'), $packages) )
								$quantity = $packages[$request->input('id')]['quantity'] + 1;
							else
								$quantity = 1;

							$packages[$request->input('id')] = ['name' => $request->input('name'), 'quantity' => $quantity];

							Cart::update($rowid, ['packages' => $packages]);
						}
						else
						{							
							$package = [$request->input('id') => ['name' => $request->input('name'), 'quantity' => 1]];
							Cart::update($rowid, ['packages' => $package]);
						}
					break;

					case 'product':
						if( Cart::content()->first()->products )
						{
							$products = Cart::content()->first()->products;							

							if( array_key_exists($request->input('id'), $products) )
								$quantity = $products[$request->input('id')]['quantity'] + 1;
							else
								$quantity = 1;

							$products[$request->input('id')] = ['name' => $request->input('name'), 'quantity' => $quantity];

							Cart::update($rowid, ['products' => $products]);
						}
						else
						{							
							$package = [$request->input('id') => ['name' => $request->input('name'), 'quantity' => 1]];
							Cart::update($rowid, ['products' => $package]);
						}
					break;
				}

				return response()->json(
					[
						'status' 		=> 'success', 
						'message' 		=> 'Please select ' . (Cart::content()->first()->qty - ($total_products + $total_packages + 1 )) . ' more boxes to continue',
						'amount' 		=> Cart::content()->first()->qty - ($total_products + $total_packages + 1 ),
						'item_amount' 	=> $quantity ? $quantity : 0
					]
				);
			}
		}
	}	




	public function postRemoveItemFromCart( Request $request )
    {
	    if( $request->ajax() )
	    {
			$rowid = Cart::content()->first()->rowid;

			if( $rowid )
			{				
				// Check and count the items already added in the shopping cart
				$total_packages = Cart::content()->first()->packages ? array_sum(array_column(Cart::content()->first()->packages, 'quantity')) : 0;
				$total_products = Cart::content()->first()->products ? array_sum(array_column(Cart::content()->first()->products, 'quantity')) : 0;

				// if( $total_products + $total_packages >= Cart::content()->first()->qty )
				// 	return response()->json(
				// 		['status' => 'error', 
				// 		'message' => 'Cart is full with items']
				// 	);

				switch( $request->input('type') )
				{
					case 'package':						
						if( Cart::content()->first()->packages )
						{
							$packages = Cart::content()->first()->packages;							

							if( array_key_exists($request->input('id'), $packages) )
								$quantity = $packages[$request->input('id')]['quantity'] - 1;

							if( $quantity == 0 )
								unset($packages[$request->input('id')]);
							else
								$packages[$request->input('id')] = ['name' => $request->input('name'), 'quantity' => $quantity];

							Cart::update($rowid, ['packages' => $packages]);
						}
						else
						{							
							$package = [$request->input('id') => ['name' => $request->input('name'), 'quantity' => 1]];
							Cart::update($rowid, ['packages' => $package]);
						}
					break;

					case 'product':
						if( Cart::content()->first()->products )
						{
							$products = Cart::content()->first()->products;							

							if( array_key_exists($request->input('id'), $products) )
								$quantity = $products[$request->input('id')]['quantity'] - 1;

							if( $quantity == 0 )
								unset($products[$request->input('id')]);
							else
								$products[$request->input('id')] = ['name' => $request->input('name'), 'quantity' => $quantity];

							Cart::update($rowid, ['products' => $products]);
						}
						else
						{							
							$package = [$request->input('id') => ['name' => $request->input('name'), 'quantity' => 1]];
							Cart::update($rowid, ['products' => $package]);
						}
					break;
				}

				return response()->json(
					[
						'status' 		=> 'success', 
						'message' 		=> 'Please select ' . (Cart::content()->first()->qty - ($total_products + $total_packages - 1 )) . ' more boxes to continue',
						'amount' 		=> Cart::content()->first()->qty - ($total_products + $total_packages - 1 ),
						'item_amount' 	=> $quantity ? $quantity : 0
					]
				);
			}
		}
	}	

}