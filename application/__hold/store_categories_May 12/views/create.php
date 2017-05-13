<h1><?= $headline ?></h1>
<?= validation_errors("<p style='color: red;'>", "</p>") ?>

<?php
	if( isset($flash) ) echo $flash;
	$form_location = base_url().$this->uri->segment(1)."/create/".$update_id;
?>

<script language='javascript'>
   
   function sel_option( obj ){
		if( obj.value == 2 ){
			alert('I am here: '+obj.value);			
			document.getElementById('selectStatus').disabled = false;
		} else {
			document.getElementById('selectStatus').disabled = true;			
		}
   }

</script>


<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>
			<?= $headtag ?></h2>
			<div class="box-icon">
				<a href="<?= base_url().$this->uri->segment(1) ?>/manage" ><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<form class="form-horizontal" method="post" action="<?= $form_location ?>" >
			  <fieldset>

				<?php
				if( $num_dropdown_options > 1 &&  !is_numeric($this->uri->segment(3)) ){ ?>
					<div class="control-group">
						<label class="control-label" for="selectStatus">Category Type</label>
						<div class="controls">
							<?php
							$options_cat = array(
						        '0'  => 'Please Select ...',
						        '1'  => 'Parent',
						        '2'  => 'Sub Category',
							);

							echo form_dropdown('category_sel', $options_cat, '0', array('id' => 'select_category', 'onChange' => 'sel_option(this)'));
							?>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="selectStatus"></label>
						<div class="controls">
							<?php
							$additional_opt = " id = selectStatus disabled = true";
							echo form_dropdown('parent_cat_id', $options, $columns['parent_cat_id'], $additional_opt);
							?>
						</div>
					</div>

				<?php
				} else {
                    echo form_hidden('parent_cat_id', 0);
				}
				?>

				<div class="control-group">
				  <label class="control-label" for="typeahead">Category Title </label>
				  <div class="controls">
					<input type="text" class="span6" name = "cat_title" value="<?= $columns['cat_title'] ?>">
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
