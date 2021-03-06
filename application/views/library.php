
<h3 class="loading"> Loading... <img src="<?= base_url() ?>/images/loading.gif" class="img-responsive" width="100px"> </h3>

<div style="display: none" id="tableHeaderLibrary">
<h3> Your library </h3>
<!-- <p> Click on an album name to see the album in more detail. <br> Click the artist name to see the artist in more detail. <br> Double click on 'Yes' or 'No' in the end column to change. <br> Use the 'Filter records' box on the right to instantly filter through every record. <br> Click on a column heading to sort by the column, click again to reverse the sort order. </p> -->
</div>
<table class="table table-hover display responsive no-wrap" id="libraryTable" style="display: none;width: 100%">
    <thead>
        <tr>
            <th style="display: none"> ID </th>
            <th> Title </th>
            <th> Artist </th>
            <th> Artist A-Z </th>
            <!-- <th> Reference </th>			 -->
            <!-- <th> Purchased On </th> -->
            <!-- <th> Purchased From </th> -->
            <th> Rating </th>
            <th> Listened </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($items as $item) { ?>
        <tr data-id="<?= $item->item_id; ?>">
            <td style="display: none"><?= $item->item_id; ?></td>
            <td><a href="/item/<?=$item->item_id;  ?>"><?= ucwords($item->title); ?></a></td>
            <td><a href="/artist/<?= $item->artist_id; ?>"><?= ucwords($item->artist_name); ?></a></td>
            <td><?= ucwords($item->artist_az_name); ?></td>
            <!-- <td><?= $item->reference; ?></td> -->
            <!-- <td><?= ($item->purchase_date != null?date('d/m/Y', strtotime($item->purchase_date)):'N/A'); ?></td> -->
            <!-- <td><?= $item->purchased_from; ?></td> -->
            <td><?= $item->rating; ?>/10</td>
            <td class="editableSelect noSelect" data-toggle="tooltip" title="Double click to change" data-value="<?= $item->listened; ?>"><?= ($item->listened == 1?'Yes':'No'); ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<script type="text/javascript">
	$(document).ready(function(){
	    $('#libraryTable').DataTable({
	    	"pageLength": 50,
    	 	"order": [[ 3, "asc" ]],
	    	"initComplete": function(settings, json) {
	    		$('.loading').hide(500);
			    $('#libraryTable').show(500);
			    $('#tableHeaderLibrary').show(500);
		  	},
		  	"language": {
			    "search": "Filter records:"
		  	},
//            responsive: true,
	    });
	});
</script>