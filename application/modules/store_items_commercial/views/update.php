<style>

	input {
		width: 75px;
		border-color: red;
	}

	.header_spacing {
		float: left; width: 25%;
	}

	.group_sep {
	    background-color: #FF9900;
	}

	.stripe_row {
	    border-color: #578EBE;	
	    background-color: #578EBE;
	    color: #fff;    
	}

	.table-condensed>thead>tr>th{
	    border-color: #578EBE;	
	    background-color: #578EBE;
	    color: #fff;    
	}

</style>


<h1><?= $headline ?></h1>
<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<?php
	if( isset($flash) ) echo $flash;	
	$form_location = base_url().$store_db_table."/submit/".$update_id;
?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>New <?= $options_hdr ?> Options</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="<?= base_url() ?>store_items/manage" ><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<!-- show image -->
			<img src="<?= base_url() ?>public/small_pic/<?= $small_img ?>" >
			<h2>Item Title: <?= $item_title ?></h2>						

			<form class="form-horizontal" method="post" action="<?= $form_location ?>" >
			
				<fieldset>			    
					<div class="control-group">
					  <label class="control-label" for="typeahead">Unit</label>
					  <div class="controls">
						<input type="text" class="span2" name = "unit_type">
					  </div>
					</div>

					<div class="control-group">
					  <label class="control-label" for="typeahead">Unit Count</label>
					  <div class="controls">
						<input type="text" class="span2" name = "unit_pkg_count">
					  </div>
					</div>

					<div class="control-group">
					  <label class="control-label" for="typeahead">Unit Weight <span style="color: green;">(Lbs.)</span> </label>
					  <div class="controls">
						<input type="text" class="span2" name = "unit_pkg_wgt">
					  </div>
					</div>

					<div class=table-responsive>
						<table class="table table-condensed">
							<thead>
								<tr >
									<th width="16%"> </th>
									<th width="16%"> Level 1</th>
									<th width="16%"> Level 2</th>
									<th width="16%"> Level 3</th>
									<th width="16%"> Level 4</th>
									<th width="16%"> Level 5</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>Quantity</th>
									<td><input type="hidden" name="level1_qty" value="1">1</td>									
									<td><input type="text" name="level2_qty"></td>
									<td><input type="text" name="level3_qty"></td>
									<td><input type="text" name="level4_qty"></td>
									<td><input type="text" name="level5_qty"></td>
								</tr>

								<tr>
									<th>Pricing</th>
									<?php if( $num_rows>=1 ){ ?>
										<td><input type="text" name="level1_pricing" value=""></td>									
									<?php } else { ?>	
										<td><input type="hidden" name="level1_pricing" 
										value="<?= $item_price ?>"><?= $currency_symbol ?><?= $item_price ?></td>
									<?php } ?>	
									<td><input type="text" name="level2_pricing"></td>
									<td><input type="text" name="level3_pricing"></td>
									<td><input type="text" name="level4_pricing"></td>
									<td><input type="text" name="level5_pricing"></td>
								</tr>

							</tbody>
						</table>
			    	</div>		
					<div class="form-actions">
					  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
					  <button type="submit" class="btn" name="submit" value="Finished">Finished</button>
					</div>
			  	</fieldset>
			</form>   

		</div>
	</div><!--/span-->
</div><!--/row-->

<?php if( $num_rows>0 ){ ?>

	<div class="row-fluid sortable">		
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon white edit"></i> 
					<span class="break">&nbsp;&nbsp; Existing <?= $options_hdr ?></span>
				</h2>
			</div>

			<div class="box-content">
				<table class="table ">

				    <?php
				         $count = 0;
				    	 foreach( $query->result() as $row ){
				    	 	$count++;
				    	 	$delete_url = base_url().$store_db_table."/delete/".$row->id; ?> 	
								<tr class ='group_sep'>
									<td colspan="7"></td>
								</tr>
								<tr >
									<th ></th>						
									<th colspan="7">
									<div class = "header_spacing">Unit: <?= $row->unit_type ?></div>
									<div class = "header_spacing">Unit Count:  <?= $row->unit_pkg_count ?></div>
									<div class = "header_spacing">Unit Weight: <?= $row->unit_pkg_wgt ?></div>
								</tr>
								<tr  class ="stripe_row ">
									<th width="6%"></th>
									<th width="16%"> Level 1</th>
									<th width="16%"> Level 2</th>
									<th width="16%"> Level 3</th>
									<th width="16%"> Level 4</th>
									<th width="16%"> Level 5</th>
									<th width="10%"></th>
								</tr>
								<tr>
									<td><?=$count ?></td>
									<td class="right"><?= $row->level1_qty ?> | <?= $currency_symbol ?><?= $row->level1_pricing ?></td>
									<td class="right"><?= $row->level2_qty ?> | <?= $currency_symbol ?><?= $row->level2_pricing ?></td>
									<td class="right"><?= $row->level3_qty ?> | <?= $currency_symbol ?><?= $row->level3_pricing ?></td>
									<td class="right"><?= $row->level4_qty ?> | <?= $currency_symbol ?><?= $row->level4_pricing ?></td>
									<td class="right"><?= $row->level5_qty ?> | <?= $currency_symbol ?><?= $row->level5_pricing ?></td>							
									<td class="center">
										<a class="btn btn-danger" href="<?= $delete_url ?>">
											<i class="halflings-icon white trash"></i> Remove  
										</a>
									</td>
								</tr>

				    <?php } ?>
			  </table>            
			</div>
		</div><!--/span-->
	</div><!--/row-->
<?php } ?>
