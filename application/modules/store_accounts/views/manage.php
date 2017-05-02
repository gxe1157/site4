<?php
	$create_url = base_url().$this->uri->segment(1)."/create";
	if( isset($flash) ) echo $flash;	
?>

<h1><?= $headline ?></h1>

<p style="margin-top: 30px,">
	<a href="<?= $create_url ?>" ><button type="button" class="btn btn-primary"><?= $add_button ?></button></a>
</p>


<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header" data-original-title >
			<h2><i class="halflings-icon white briefcase"></i><span class="break"></span><?= $headtag ?></h2>
			<div class="box-icon">
				<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
				<a href="#" ><i class="halflings-icon white remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
					  <th>First Name</th>
					  <th>Last Name</th>
					  <th>Company</th>
					  <th>Date Created</th>
					  <th>-----</th>					  
					  <th>Actions</th>
				  </tr>
			  </thead>   
			  <tbody>

					<?php
						$this->load->module('timedates');					
						foreach( $columns->result() as $row ) {
						$edit_account_url = $create_url."/".$row->id;	
						$create_date = $this->timedates->get_nice_date($row->create_date, 'cool')			
					?>
						<tr>
							<td class="right"><?= $row->firstname ?></td>
							<td class="right"><?= $row->lastname ?></td>
							<td class="right"><?= $row->company ?></td>
							<td class="right"><?= $create_date ?></td>
							<td class="right">&nbsp;</td>

							<td class="center">
								<a class="btn btn-success" href="#">
									<i class="halflings-icon white zoom-in"></i>  
								</a>
								<a class="btn btn-info" href="<?= $edit_account_url ?>">
									<i class="halflings-icon white edit"></i>  
								</a>
							</td>
						</tr>
			    	<?php } ?>			    

			  </tbody>
		  </table>            
		</div>
	</div><!--/span-->

</div><!--/row-->