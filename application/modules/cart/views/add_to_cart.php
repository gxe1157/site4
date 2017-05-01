<div style="padding: 10px;">
  	<form class="form-horizontal" action="#">
	    <div class="form-group">
	      <label class="control-label col-sm-4" for="item_id">Item Id:</label>
	      <div class="col-sm-4">
	        <input type="text" style="text-align:right;" class="form-control" id="item_id" name="item_id" value="<?= $item_id ?>">
	      </div>
	    </div>

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
	        <input type="text" style="text-align:right;" class="form-control" id="qty" name="qty" value="">
	      </div>
	    </div>
		<div class="form-group col-md-12" style="text-align: center; margin-top: 3px; margin-left: 6px;">
			<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true" ></span> Add To Basket </button>
		</div>
	</form>
</div>