 <style>
    /* cart/view/add_to_cart.php */
	input{
		text-align:right;
	}	

 	.cart_box{
 		padding: 10px;
 		background-color: #ddd;
 		margin-top: 24px;
 		border: 3px solid #666;
		border-radius: 9px;"
 	}	

	.button_submit{
		padding: 5px;
		display: block;
		text-align: center;
	}

 </style>

 

<div class="box-content cart_box" >

	<form class="form-horizontal" action="#">
	    <div class="form-group">
	      <label class="control-label col-sm-4" for="item_id">Item Id:</label>
	      <div class="col-sm-4">
	        <input type="text" class="form-control" id="item_id" name="item_id" value="<?= $item_id ?>"  disabled>
	      </div>
	    </div>

		<?php if( $num_unit_types>0 ){ ?>
	    <div class="form-group">
	      <label class="control-label col-sm-4" for="item_color">Unit:</label>
	      <div class="col-sm-7">
			<?php
			echo form_dropdown('item_color', $unit_type_options, $submitted_unit_type, array('class' =>'form-control' ));
			?>			
	      </div>
	    </div>
		<?php } ?>

		<?php if( $num_colors>0 ){ ?>
	    <div class="form-group">
	      <label class="control-label col-sm-4" for="item_color">color:</label>
	      <div class="col-sm-7">
			<?php
			echo form_dropdown('item_color', $color_options, $submitted_color, array('class' =>'form-control' ));
			?>			
	      </div>
	    </div>
		<?php } ?>

		<?php if( $num_sizes>0 ){ ?>
	    <div class="form-group">
	      <label class="control-label col-sm-4" for="item_size">Size:</label>
	      <div class="col-sm-7">
			<?php
			echo form_dropdown('item_size', $size_options, $submitted_size, array('class' =>'form-control'));
			?>			
	      </div>
	    </div>
		<?php } ?>

	    <div class="form-group">
	      <label class="control-label col-sm-4" for="qty">Quanity:</label>
	      <div class="col-sm-4">
	        <input type="text" class="form-control" id="qty" name="qty" value="">
	      </div>
	    </div>
	    <div class = "button_submit">
			<button class="btn btn-primary" type="submit">
				<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true" ></span>
				Add To Basket
			</button>
		</div>

	</form>

</div>
