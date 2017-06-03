<h1><?= $cat_title ?></h1>

<div class="row">
	<?php foreach($query->result() as $row) {
		$item_title = $row->item_title;
		$small_pic  = $row->small_pic;
		$item_price = $row->item_price;		
		$was_price  = $row->was_price;
		$small_pic_path = base_url()."public/small_pic/".$small_pic;

	?>
		<div class="col-md-2 img-thumbnail" style="margin: 6px; min-height: 200px;" >
			<img src="<?= $small_pic_path ?>"  class="img-responsive" alt="<?= $item_title ?>">
			<br>
			<h6><?= $item_title ?></h6>
			<div style="clear: both; color: red; font-weight: bold;">$<?= number_format($item_price,2) ?>
				<span style="font-weight: normal; color: #999; text-decoration: line-through; "><?= $was_price ?></span>
			</div>

		</div>
	<?php } ?>
</div>
