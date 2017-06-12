<style>
	/* cart/view/add_to_table.php */
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

	.box-content{
		width: 95%;
		padding-left: 15px;
	}
</style>


<div class="box-content">
	<table class="table table-condensed">
	    <?php
	         $count = 0;
	    	 foreach( $query->result() as $row ){
	    	 	$count++;
	    	 	?>
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
						</td>
					</tr>

	    <?php } ?>
		<tr class ='group_sep'>
			<td colspan="7"></td>
		</tr>	    
  </table>            
</div>
