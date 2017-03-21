<?php

class TrackModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	function getItemTracks($itemId) {
        $tracks = $this->db->select()
                ->where('item_id', $itemId)
                ->where('del', 0)
                ->order_by('track_album_number ASC')
                ->get('tracks');

        return $tracks->result();
    }

    function updateTrack($field, $value, $itemId, $order) {
        $data = array(
            $field => $value
        );

        $this->db->where('item_id', $itemId);
        $this->db->where('track_album_number', $order);
        $query = $this->db->update('tracks', $data);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function addNewTrack($trackName, $duration, $itemId, $albumNumber, $artist) {
       
        $sql = "
            INSERT INTO tracks
            (item_id, track_album_number, artist_id, track_name, track_duration)
            VALUES ($itemId, $albumNumber, $artist, '$trackName', '$duration')
        ";

        $query = $this->db->query($sql);

        // $data = array(
        //     'track_album_number' => $albumNumber,
        //     'item_id' => $itemId,
        //     'track_name' => $trackName,
        //     'artist_id' => $artist,
        //     'track_duration' => $duration
        // );

        // $query = $this->db->insert('tracks', $data);

        if ($query) {
            return $this->db->insert_id();
        } else {
            return 0;
        }
    }

    public function deleteTrack($id) {
        $sql = "UPDATE tracks SET del = 1 WHERE track_id = $id";

        $query = $this->db->query($sql);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}

?>