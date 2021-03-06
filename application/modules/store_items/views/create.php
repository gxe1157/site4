
<h1><?= $headline ?></h1>
<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<?php
	if( isset($flash) ) echo $flash;
	$form_location = base_url()."store_items/create/".$update_id;
	// $this->lib->checkArray($columns,1);
?>

<?php if( is_numeric($update_id) ) { ?>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Options</h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="<?= base_url().$this->uri->segment(1) ?>/manage" ><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
			    <?php  if( empty($columns['big_pic']) ) { ?>
					<a href="<?= base_url() ?>store_items/upload_image/<?= $update_id ?> ">
					<button type="button" class="btn btn-primary">Upload Item Image</button></a>
				<?php  } else { ?>
					<a href="<?= base_url() ?>store_items/delete_image/<?= $update_id ?> ">
					<button type="button" class="btn btn-danger">Delete Item Image</button></a>
				<?php  } ?>


				<a href="<?= base_url() ?>store_items_commercial/update/<?= $update_id ?> ">
				<button type="button" class="btn btn-primary" id="button_BP">Bulk Pricing</button></a>

				<a href="<?= base_url() ?>store_item_colors/update/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Item Color</button></a>
				<a href="<?= base_url() ?>store_item_sizes/update/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Item Size</button></a>
				<a href="<?= base_url() ?>store_cat_assign/update/<?= $update_id ?>"><button type="button" class="btn btn-primary">Update Item Categories</button></a>
				<a href="<?= base_url() ?>store_items/deleteconf/<?= $update_id ?>"><button type="button" class="btn btn-danger">Delete Item</button></a>
				<a href="<?= base_url() ?>store_items/view/<?= $update_id ?>/preview"><button type="button" class="btn btn-default">Preview Page</button></a>
			</div>

		</div><!-- end 12 span -->
	</div><!-- end row-fluid sortable -->
<?php } ?>


<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Details</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="<?= base_url().$this->uri->segment(1) ?>/manage" ><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<form class="form-horizontal" method="post" action="<?= $form_location ?>" >
			  <input type="hidden" name="big_pic" value="<?= $columns['big_pic'] ?>" />
			  <input type="hidden" name="small_pic" value="<?= $columns['small_pic'] ?>" />

			  <fieldset>
					<div class="control-group">
						<label class="control-label" for="selectSetup">Item Pricing</label>
						<div class="controls">
							<?php
							$additional_opt = ' id ="selectSetup"
								 onChange ="javascript: selSetup();"';

							$options = array(
							        '0' => 'Please Select....',
							        '1' => 'Retail',
							        '2' => 'Bulk Pricing'
							);
							echo form_dropdown('item_setup', $options, $columns['item_setup'], $additional_opt	);
							?>
						</div>
				</div>

				<div class="control-group">
				  <label class="control-label" for="typeahead">Item Title </label>
				  <div class="controls">
					<input type="text" class="span6" name = "item_title" value="<?= $columns['item_title'] ?>">
				  </div>
				</div>


				<div class="control-group">
				  <label class="control-label" for="typeahead">Item Price </label>
				  <div class="controls">
					<input type="text" class="span2" name = "item_price" value="<?= $columns['item_price'] ?>">
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label" for="typeahead">Was Price <span style="color: green;">(Optional)</span> </label>
				  <div class="controls">
					<input type="text" class="span2" name = "was_price" value="<?= $columns['was_price']  ?>">
				  </div>
				</div>

				<div class="control-group">
					<label class="control-label" for="selectStatus">Status</label>
					<div class="controls">
						<?php
						$additional_opt = " id = selectStatus";
						$options = array(
						        '' => 'Please Select....',
						        '1' => 'Active',
						        '0' => 'Inactive'
						);
						echo form_dropdown('status', $options, $columns['status'], $additional_opt);
						?>
					</div>
			  </div>

				<div class="control-group hidden-phone">
				  <label class="control-label" for="textarea2">Item Description</label>
				  <div class="controls">
					<textarea class="cleditor" id="textarea2" rows="2" name = "item_description">
						<?= $columns['item_description']  ?>
					</textarea>
				  </div>
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
				  <button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
				</div>
			  </fieldset>
			</form>

		</div>
	</div><!--/span-->

</div><!--/row-->

<!-- Image display and delete -->
<?php
if( isset($columns['big_pic']) && $columns['big_pic'] != "" ) { ?>
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i><span class="break"></span>Item Image</h2>
				<div class="box-icon">
					<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
					<a href="<?= base_url().$this->uri->segment(1) ?>/manage" ><i class="halflings-icon white remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<img src="<?= base_url() ?>public/big_pic/<?= $columns['big_pic'] ?>" >
			</div>
		</div><!-- end 12 span -->
	</div><!-- end row-fluid sortable -->
<?php
}
?>

<script langauge="javascript">
	var update_id = "<?= $update_id ?>";

	var _ = function( id ){
		return document.getElementById(id);
	}

	function selSetup( arg ){
		var x = _('selectSetup').value;
		if( x == 0 ) {
			alert('Error on selection... Please re-enter....')
			return;
		}

		_('button_BP').style.backgroundColor = x == 2 ? "#578EBE" : "#ccc";       	
		_('button_BP').disabled = x == 2 ? false : true;

		if( arg == undefined ){
			sendData = "item_setup="+_('selectSetup').value;
			sendData += "&update_id="+update_id;		
	    	ajaxPost(sendData);
    	}		
	}

	var ajaxPost = function(sendData){
	   // alert( 'sendData: '+sendData );

       var hr = new XMLHttpRequest();
       hr.open("POST", "http://localhost/site4/store_items/ajaxPost", true);
       hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

       hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
		  //alert( hr.readyState+" <=> "+hr.status );
		  var data = hr.responseText;
		  alert( 'Item Pricing has been updated...... ' );		  
        } // End hr.readyState == 4 && hr.status == 200
       } // End hr.onreadystatechange
      hr.send(sendData);
    }

    if( update_id ){
    	// update must conatin an item number
    	selSetup( 'init' );
	}

</script>

