<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Wrapper -->
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="shopping-cart shopping-cart-shipping">
                    <div class="row">
                        <div class="col-sm-12 col-lg-7">
                            <div class="left">
                                <h1 class="cart-section-title"><?php echo trans("checkout"); ?></h1>

                                <?php if (!auth_check()): ?>
                                    <div class="row m-b-15">
                                        <div class="col-12 col-md-6">
                                            <p><?php echo trans("checking_out_as_guest"); ?></p>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <p class="text-right"><?php echo trans("have_account"); ?>&nbsp;<a href="javascript:void(0)" class="link-underlined" data-toggle="modal" data-target="#loginModal"><?php echo trans("login"); ?></a></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="tab-checkout tab-checkout-open m-t-0">
                                    <h2 class="title">1.&nbsp;&nbsp;<?php echo trans("shipping_information"); ?></h2>
                                    <?php echo form_open("cart_controller/shipping_post", ['id' => 'form_validate']); ?>
                                    <div class="row">
                                        <div class="col-12 cart-form-shipping-address">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 m-b-sm-15">
                                                        <label><?php echo trans("first_name"); ?>*</label>
                                                        <input type="text" name="shipping_first_name" class="form-control form-input" value="<?php echo $shipping_address->shipping_first_name; ?>" required>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label><?php echo trans("last_name"); ?>*</label>
                                                        <input type="text" name="shipping_last_name" class="form-control form-input" value="<?php echo $shipping_address->shipping_last_name; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 m-b-sm-15">
                                                        <label><?php echo trans("email"); ?>*</label>
                                                        <input type="email" name="shipping_email" class="form-control form-input" value="<?php echo $shipping_address->shipping_email; ?>" required>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label><?php echo trans("phone_number"); ?>*</label>
                                                        <input type="text" name="shipping_phone_number" class="form-control form-input" value="<?php echo $shipping_address->shipping_phone_number; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo trans("address"); ?> 1*</label>
                                                <input type="text" name="shipping_address_1" class="form-control form-input" value="<?php echo $shipping_address->shipping_address_1; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo trans("address"); ?> 2 (<?php echo trans("optional"); ?>)</label>
                                                <input type="text" name="shipping_address_2" class="form-control form-input" value="<?php echo $shipping_address->shipping_address_2; ?>">
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 m-b-sm-15">
                                                        <label><?php echo trans("province"); ?>*</label>
                                                        <div class="selectdiv">
                                                            <select id="provinces" name="shipping_state_id" class="form-control" required>
                                                                <option value="" selected><?php echo trans("select_province"); ?></option>
                                                                <?php foreach ($provinces as $item): ?>
                                                                    <option value="<?php echo $item['province_id']; ?>" <?php if ($item['province_id'] == $shipping_address->shipping_state_id): ?>selected<?php endif; ?>>
                                                                    	<?php echo html_escape($item['province']); ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label><?php echo trans("city"); ?>*</label>
                                                        <select id="cities" name="shipping_city_id" class="form-control" required>
                                                        	<option value="" selected><?php echo trans("select_city"); ?></option>
                                                            <?php foreach ($cities as $item): ?>
                                                                <option value="<?php echo $item['city_id']; ?>" <?php if ($item['city_id'] == $shipping_address->shipping_city_id): ?>selected<?php endif; ?>>
                                                                	<?php echo html_escape($item['city_name']); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 m-b-sm-15">
                                                        <label><?php echo trans("subdistrict"); ?>*</label>
                                                        <input type="text" name="shipping_city" class="form-control form-input" value="<?php echo $shipping_address->shipping_city; ?>" required>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label><?php echo trans("zip_code"); ?>*</label>
                                                        <input type="text" name="shipping_zip_code" class="form-control form-input" value="<?php echo $shipping_address->shipping_zip_code; ?>" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12" style="border-bottom: solid thin #ccc; margin-bottom: 50px;">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-12 m-b-sm-15">

			                                            <div class="cart-order-details">
															<?php if (!empty($cart_items)):
																foreach ($cart_items as $cart_item):
																	$product = get_available_product($cart_item->product_id);
																	if (!empty($product)):
																		if ($product->product_type == 'physical') {
																			$is_physical = true;
																		} ?>
																		<div class="item">
																			<div class="item-left">
																				<div class="img-cart-product">
																					<a href="<?php echo generate_product_url($product); ?>">
																						<img src="<?php echo $img_bg_product_small; ?>" data-src="<?php echo get_product_image($cart_item->product_id, 'image_small'); ?>" alt="<?php echo html_escape($product->title); ?>" class="lazyload img-fluid img-product" onerror="this.src='<?php echo $img_bg_product_small; ?>'">
																					</a>
																				</div>
																			</div>
																			<div class="item-right">
																				<div class="row">
																					<div class="col-6">
																						<?php if ($product->product_type == 'digital'): ?>
																							<div class="list-item">
																								<label class="label-instant-download label-instant-download-sm"><i class="icon-download-solid"></i><?php echo trans("instant_download"); ?></label>
																							</div>
																						<?php endif; ?>
																						<div class="list-item">
																							<a href="<?php echo generate_product_url($product); ?>">
																								<?php echo html_escape($cart_item->product_title); ?>
																							</a>
																						</div>
																						<div class="list-item seller">
																							<?php echo trans("by"); ?>&nbsp;<a href="<?php echo lang_base_url() . 'profile' . '/' . $product->user_slug; ?>"><?php echo get_shop_name_product($product); ?></a>
																						</div>
																						<div class="list-item m-t-15">
																							<label><?php echo trans("quantity"); ?>:</label>
																							<strong class="lbl-price"><?php echo $cart_item->quantity; ?></strong>
																						</div>
																						<div class="list-item">
																							<label><?php echo trans("price"); ?>:</label>
																							<strong class="lbl-price"><?php echo print_price($cart_item->total_price, $cart_item->currency); ?></strong>
																						</div>
																						<?php if ($product->product_type != 'digital' && $this->form_settings->shipping == 1): ?>
																							<div class="list-item">
																								<label></label>
																							</div>
																						<?php endif; ?>
																					</div>
																					<div class="col-6">
																						<div class="selectdiv" style="margin-bottom: 10px;">

								                                                            <select id="shipping_provider" name="shipping_provider[<?php echo $cart_item->cart_item_id; ?>]" class="form-control" onChange="get_cost('<?php echo $cart_item->cart_item_id; ?>')" required>
								                                                                <option value="" selected><?php echo trans("select_shipping_provider"); ?></option>
								                                                                <option value="jne" 	<?php if ($shipping_items['shipping_provider'][$cart_item->cart_item_id] =='jne'): ?>selected<?php endif; ?>  >JNE</option>
								                                                                <option value="pos" 	<?php if ($shipping_items['shipping_provider'][$cart_item->cart_item_id] =='pos'): ?>selected<?php endif; ?>>POS</option>
								                                                                <option value="tiki"	<?php if ($shipping_items['shipping_provider'][$cart_item->cart_item_id] =='tiki'): ?>selected<?php endif; ?> >TIKI</option>
								                                                            </select>
								                                                        </div>
								                                                        <div class="selectdiv">
								                                                        	
								                                                            <select id="shipping_service_code_<?php echo $cart_item->cart_item_id; ?>" name="shipping_service_code[<?php echo $cart_item->cart_item_id; ?>]" class="form-control" required>
								                                                            	<?php foreach ($shipping_items['services'][$cart_item->cart_item_id] as $key => $value): ?>
								                                                            	<option value="<?php echo $value['value'] ?>" <?php if($value['value'] == $shipping_items['shipping_service_code'][$cart_item->cart_item_id]): ?>selected<?php endif; ?>><?php echo $value['label'] ?></option>
								                                                            	<?php endforeach; ?>
								                                                            </select>
								                                                        </div>
																					</div>
																				</div>
																			</div>
																		</div>
																	<?php endif;
																endforeach;
															endif; ?>
														</div>

													</div>
												</div>
											</div>


                                        </div>
                                        <div class="col-12 cart-form-billing-address" <?php echo ($shipping_address->use_same_address_for_billing == 0) ? 'style="display: block;"' : ''; ?>>
                                            <h3 class="title-billing-address"><?php echo trans("billing_address") ?></h3>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 m-b-sm-15">
                                                        <label><?php echo trans("first_name"); ?>*</label>
                                                        <input type="text" name="billing_first_name" class="form-control form-input" value="<?php echo $shipping_address->billing_first_name; ?>" required>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label><?php echo trans("last_name"); ?>*</label>
                                                        <input type="text" name="billing_last_name" class="form-control form-input" value="<?php echo $shipping_address->billing_last_name; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 m-b-sm-15">
                                                        <label><?php echo trans("email"); ?>*</label>
                                                        <input type="email" name="billing_email" class="form-control form-input" value="<?php echo $shipping_address->billing_email; ?>" required>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label><?php echo trans("phone_number"); ?>*</label>
                                                        <input type="text" name="billing_phone_number" class="form-control form-input" value="<?php echo $shipping_address->billing_phone_number; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo trans("address"); ?> 1*</label>
                                                <input type="text" name="billing_address_1" class="form-control form-input" value="<?php echo $shipping_address->billing_address_1; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label><?php echo trans("address"); ?> 2 (<?php echo trans("optional"); ?>)</label>
                                                <input type="text" name="billing_address_2" class="form-control form-input" value="<?php echo $shipping_address->billing_address_2; ?>">
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 m-b-sm-15">
                                                        <label><?php echo trans("country"); ?>*</label>
                                                        <div class="selectdiv">
                                                            <select id="countries" name="billing_country_id" class="form-control" required>
                                                                <option value="" selected><?php echo trans("select_country"); ?></option>
                                                                <?php foreach ($countries as $item): ?>
                                                                    <option value="<?php echo $item->id; ?>" <?php echo ($shipping_address->billing_country_id == $item->id) ? 'selected' : ''; ?>><?php echo html_escape($item->name); ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label><?php echo trans("state"); ?>*</label>
                                                        <input type="text" name="billing_state" class="form-control form-input" value="<?php echo $shipping_address->billing_state; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-md-6 m-b-sm-15">
                                                        <label><?php echo trans("city"); ?>*</label>
                                                        <input type="text" name="billing_city" class="form-control form-input" value="<?php echo $shipping_address->billing_city; ?>" required>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label><?php echo trans("zip_code"); ?>*</label>
                                                        <input type="text" name="billing_zip_code" class="form-control form-input" value="<?php echo $shipping_address->billing_zip_code; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="use_same_address_for_billing" value="1" id="use_same_address_for_billing" <?php echo ($shipping_address->use_same_address_for_billing == 1) ? 'checked' : ''; ?>>
                                                    <label for="use_same_address_for_billing" class="custom-control-label"><?php echo trans("use_same_address_for_billing"); ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group m-t-15">
                                        <a href="<?php echo lang_base_url(); ?>cart" class="link-underlined link-return-cart"><&nbsp;<?php echo trans("return_to_cart"); ?></a>
                                        <button type="submit" name="submit" value="update" class="btn btn-lg btn-custom float-right"><?php echo trans("continue_to_payment_method") ?></button>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>

                                <div class="tab-checkout tab-checkout-closed-bordered">
                                    <h2 class="title">2.&nbsp;&nbsp;<?php echo trans("payment_method"); ?></h2>
                                </div>

                                <div class="tab-checkout tab-checkout-closed-bordered border-top-0">
                                    <h2 class="title">3.&nbsp;&nbsp;<?php echo trans("payment"); ?></h2>
                                </div>
                            </div>
                        </div>

						<?php if ($mds_payment_type == 'promote') {
							$this->load->view("cart/_order_summary_promote");
						} else {
							$this->load->view("cart/_order_summary");
						} ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wrapper End-->


<script type="text/javascript">
	$('#provinces').change(function() {
		$('#cities').html('<option>Loading...</option>')
		$.ajax({
	        type: "GET",
	        url: base_url + "ajax_controller/cities/" + $('#provinces').val(),
	        success: function (response) {
	        	var cities = JSON.parse(response);

	        	var options = "";
	        	for (var i = 0; i < cities.length; i++) {
	        		var city = cities[i]
	        		options += "<option value='"+city.city_id+"'>"+city.city_name+"</option>"
	        	}
	        	$('#cities').html(options)
	        }
	    });
	});

	function get_cost(cart_item_id) {
		$.ajax({
	        type: "GET",
	        url: base_url + "ajax_controller/cost/" + $('#cities').val() + '/' + $('#shipping_provider').val() + '/' + cart_item_id,
	        success: function (response) {
	        	var options = "";

	        	var data = JSON.parse(response)

	        	for (var i = 0; i < data.results.length; i++) {
	        		var result = data.results[i]

	        		for (var j = 0; j < result.costs.length; j++) {
		        		var cost = result.costs[j]

		        		var cost_detail = cost.cost[0]

		        		options += "<option value='"+cost.service+"'>" + cost_detail.etd + ' Hari Rp ' + cost_detail.value + ' - '+ cost.description + " ["  + cost.service + "] </option>"
		        	}
	        	}

	        	$('#shipping_service_code_' + cart_item_id).html(options); 
	        }
	    });
	}

</script>
