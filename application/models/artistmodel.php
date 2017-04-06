<?php

class ArtistModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	public function addArtist($artist_name, $artist_az) {
		$data = array(
		   	'artist_name' => $artist_name,
		   	'artist_az_name' => $artist_az
		);

		$this->db->insert('artists', $data);
	}

	public function getSimilarArtists($artistName) {
		$url = 'http://ws.audioscrobbler.com/2.0/?method=artist.getsimilar&artist='. urlencode($artistName) .'&limit=4&api_key=797d57115973701485bcb92ebb8ea847&format=json';

		$response = json_decode(file_get_contents($url));

		return $response;
	}

	public function getArtists($text) {
		$query = $this->db->select()
				->like('artist_name', $text)
				->get('artists');

		return $query->result();

	}

	public function getArtist($identifier) {
		if(is_numeric($identifier)) {
			// ID
			$column = 'artist_id';
		} else {
			// Name
			$column = 'artist_name';
		}

		$query = $this->db->select()
				->where($column, $identifier)
				->get('artists');

		if($query->num_rows() > 0) {
			$results = $query->result();
			return $results[0]->artist_id;
		} else {
			return 0;
		}

	}

	public function createNewArtist($name, $az) {
		$data = array(
	        'artist_name' => $name,
	        'artist_az_name' => $az
		);

		$query = $this->db->insert('artists', $data);

		return $this->db->insert_id();
	}

	public function getArtistAlbums($id) {
		$query = $this->db->select()
				->where('artist_id', $id)
				->get('library');

		return $query->result();
	}

	public function getArtistInfo($id) {
		$query = $this->db->select()
			->where('artist_id', $id)
			->get('artists');

		return $query->result();
	}

	public function getAllArtists() {
		$sql = "
			SELECT a.artist_id, a.artist_name, a.artist_az_name, (
				SELECT COUNT(item_id) FROM library WHERE artist_id = a.artist_id
			) AS cd_count
			FROM artists a
			ORDER BY artist_id DESC
		";

		// echo "SELECT a.artist_id, a.artist_name, a.artist_az_name, (
		// 		SELECT COUNT(item_id) FROM library WHERE artist_id = a.artist_id
		// 	) AS cd_count
		// 	FROM artists a
		// 	ORDER BY artist_id DESC";
		// 	die();

		$query = $this->db->query($sql);

		return $query->result();
	}

	public function addView($id) {
		$data = array(
	        'artist_id' => $id,
		);

		$query = $this->db->insert('artist_views', $data);

		if($query) {
			return true;
		} else {
			return false;
		}
	}

	public function getFavArtists() {
        $sql = "
            SELECT COUNT(view_id) as views, artist_views.artist_id, artist_name
            FROM artist_views
            LEFT JOIN artists
            ON artists.artist_id = artist_views.artist_id
            GROUP BY artist_views.artist_id
            ORDER BY COUNT(view_id) DESC,
            timestamp DESC
            LIMIT 5
        ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }
}	

?>