<div class="row">
	<div class="col-xs-12 col-sm-6">
		<div class="row">
			<div class="artistBanner margin-bottom col-xs-12 text-center">
				<h2> <i class="fa fa-music"></i> Recently Added </h2>
			</div>
		</div>
		<div class="row">
			<div id="recentlyAddedCarousel" class="carousel slide" data-ride="carousel" data-interval="3000" data-pause="false">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#recentlyAddedCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#recentlyAddedCarousel" data-slide-to="1"></li>
					<li data-target="#recentlyAddedCarousel" data-slide-to="2"></li>
					<li data-target="#recentlyAddedCarousel" data-slide-to="3"></li>
					<li data-target="#recentlyAddedCarousel" data-slide-to="4"></li>
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<?php $counter = 0; ?>
					<?php foreach ($recently_added as $item) { ?>
					<div class="item <?= ($counter == 0?'active':'') ?> homeCarItem">
						<a href="/item/<?= $item->item_id ?>"><img src="<?= ($item->album_image?$item->album_image:base_url() . 'images/default.png'); ?>" class="img-responsive"></a>
						<h3> <a href="/item/<?= $item->item_id ?>"><?= $item->title; ?></a> by <a href="/artist/<?= $item->artist_id ?>"><?= $item->artist_name ?></a> </h3>
						<h5> Added: <?= date('d/m/Y', strtotime($item->created_at)) ?> </h5>
					</div>
					<?php $counter++; ?>
					<?php } ?>
				</div>
				<!-- Left and right controls -->
				<!-- <a class="left carousel-control" href="#recentlyAddedCarousel" role="button" data-slide="prev">
							<span class="glyphicon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#recentlyAddedCarousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
				</a> -->
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-6">
		<div class="row">
			<div class="artistBanner margin-bottom col-xs-12 text-center">
				<h2> <i class="fa fa-headphones"></i> Recently Viewed </h2>
			</div>
		</div>
		<div class="row">
			<div id="recentlyViewedCarousel" class="carousel slide" data-ride="carousel" data-interval="3500" data-pause="false">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#recentlyViewedCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#recentlyViewedCarousel" data-slide-to="1"></li>
					<li data-target="#recentlyViewedCarousel" data-slide-to="2"></li>
					<li data-target="#recentlyViewedCarousel" data-slide-to="3"></li>
					<li data-target="#recentlyViewedCarousel" data-slide-to="4"></li>
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<?php $counter = 0; ?>
					<?php foreach ($recently_viewed as $item) { ?>
					<div class="item <?= ($counter == 0?'active':'') ?> homeCarItem">
						<a href="/item/<?= $item->item_id ?>"><img src="<?= ($item->album_image?$item->album_image:base_url() . 'images/default.png'); ?>" class="img-responsive"></a>
						<h3> <a href="/item/<?= $item->item_id ?>"><?= $item->title; ?></a> by <a href="/artist/<?= $item->artist_id ?>"><?= $item->artist_name ?></a> </h3>
						<h5> Viewed: <?= date('d/m/Y H:i:s', strtotime($item->timestamp)) ?> </h5>
					</div>
					<?php $counter++; ?>
					<?php } ?>
				</div>
				<!-- Left and right controls -->
				<!-- <a class="left carousel-control" href="#recentlyViewedCarousel" role="button" data-slide="prev">
						<span class="glyphicon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#recentlyViewedCarousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
				</a> -->
			</div>
		</div>
	</div>
</div>
<!-- <div class="row">
						<div class="col-xs-12 col-sm-5 homeSquare left">
												<div class="text text-center">
																		<i class="fa fa-music"></i><br>
																		<h5> Recently Added </h5>
												</div>
												<div class="recentlyAdded">
			<?php
				$count = 0;
				foreach ($recently_added as $item) {
					echo '
						<div id="item'. $count .'">
													<p>
																			'. $item->title .' - '. $item->artist_name .'
													</p>
													<a href="/item/'. $item->item_id .'" class="viewItemBtn"> View </a>
						</div>
					';
					$count++;
				}
			?>
		</div>
	</div>
	<div class="col-sm-2"></div>
	<div class="col-xs-12 col-sm-5 homeSquare">
		<div class="text text-center">
			<i class="fa fa-headphones"></i><br>
			<h5> Recently Listened </h5>
		</div>
	</div>
</div> -->
<div class="row">
	<div class="artistBanner margin-bottom col-xs-12 text-center">
		<h2> Stats </h2>
	</div>
</div>
<table class="table table-hover">
	<thead>
		<tr>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td> CD's added this week: </td>
			<td> <?= $cd_week; ?> </td>
		</tr>
		<tr>
			<td> CD's added this month: </td>
			<td> <?= $cd_month; ?> </td>
		</tr>
		<tr>
			<td> CD's added this year: </td>
			<td> <?= $cd_year; ?> </td>
		</tr>
		<tr>
			<td> CD's Listened to: </td>
			<td> <?= $cd_listened_count; ?>/<?= $cd_count; ?> </td>
		</tr>
	</tbody>
</table>
<div class="row">
	<div class="artistBanner margin-bottom col-xs-12 text-center">
		<h2> Favourite Albums </h2>
	</div>
</div>
<table class="table table-hover">
	<thead>
		<tr>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($favourite_albums as $album) { ?>
		<tr>
			<td> <?= $album->title; ?> </td>
			<td> Viewed <?= $album->views ?> times </td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<div class="row">
	<div class="artistBanner margin-bottom col-xs-12 text-center">
		<h2> Favourite Artists </h2>
	</div>
</div>
<table class="table table-hover">
	<thead>
		<tr>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($favourite_artists as $artist) { ?>
		<tr>
			<td> <?= $artist->artist_name; ?> </td>
			<td> Viewed <?= $artist->views ?> times </td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<script type="text/javascript">
	$('.carousel').carousel({
	pause: "false",
	});
</script>