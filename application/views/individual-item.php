<?php
echo "<pre>" . print_r($item_info, TRUE) . "</pre><br>";
echo "<pre>" . print_r($tracks, TRUE) . "</pre><br>";
echo "<pre>" . print_r($notes, TRUE) . "</pre><br>";
$item = $item_info[0];
?>
<div class="row">
	<div class="col-xs-12 col-sm-7">
		<h3> <?= $item_info[0]->title ?> - <?= $item_info[0]->artist_name ?> </h3>
		<h6> Item #<?= $item->item_id; ?> </h6>
	</div>
	<div class="col-xs-12 col-sm-5 ratingContainer">
		<?php 

			foreach ($item_info as $data) {
				$rating = $data->rating;

				for ($i = 0; $i < 10; $i++) { 
					if ($i < $rating) {
						echo '<i class="fa fa-star" id="star'. $i .'" data-id="'. $data->item_id .'" data-original-rating="'. $data->rating .'"></i>';
					} else {
						echo '<i class="fa fa-star-o" id="star'. $i .'" data-id="'. $data->item_id .'" data-original-rating="'. $data->rating .'"></i>';
					}

				}

			}

		?>
	</div>
</div>

<div class="row">
	<div class="moreInfoBanner col-xs-12">
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<h5> Purchased On: <?= (
					isset($item->purchase_date) && $item->purchase_date > ''
					?$item->purchase_date
					:
					'N/A'
					); ?></h5>
			</div>
			<div class="col-xs-12 col-sm-4">
				<h5> Purchased at: <?= (isset($item->purchased_from) && $item->purchased_from > ''?$item->purchased_from:'N/A'); ?></h5>
			</div>
			<div class="col-xs-12 col-sm-4">
				
			</div>
		</div>
	</div>
</div>