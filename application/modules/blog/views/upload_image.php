<h1><?= $headline ?></h1>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon white edit"></i><span class="break"></span>Upload Image</h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="<?= base_url() ?>store_items/create/<?= $update_id ?>" ><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<?php 

			    if( isset( $error ) ) {
			        foreach( $error as $value ){
			        	echo $value;
			        }
			    } 
			?>

			<?php echo form_open_multipart('blog/do_upload/'.$update_id, array('class' => 'form-horizontal') ); ?>
				<h2>Item Title: <?= $page_title ?></h2>

				<p>Please choose a file from your computer then press 'Upload'.</p>

			  	<fieldset>
					<div class="control-group">
						<label class="control-label" for="fileInput">File input</label>
						<div class="controls">
							<input class="input-file uniform_on" id="userfile" type="file" name="userfile" size="20" >
						</div>
					</div>          
					<div class="form-actions">
						<button type="submit" class="btn btn-primary" name="submit" value="Upload">Upload</button>
					  <button type="submit" class="btn" name="submit" value="Cancel">Cancel</button>
					</div>
			  </fieldset>
			</form>   

		</div>

	</div><!-- end 12 span -->
</div><!-- end row-fluid sortable -->