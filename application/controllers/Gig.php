<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gig extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('itemmodel');
        $this->load->model('notemodel');
        $this->load->model('trackmodel');
        $this->load->model('artistmodel');
        $this->load->model('reviewmodel');
        $this->load->model('gigmodel');
        $this->load->model('setlistmodel');
	}

	public function getGigByDate($date, $artistName) {
		echo $this->gigmodel->getGigByDate($date, $artistName);
	} 

    public function addGig() {

        if (isset($_POST)) {

            $params = array(
                'date' => date('Y-m-d h:i:s', strtotime($_POST['date'])),
                'venue' => $_POST['venue'],
                'tour' => $_POST['tour'],
                'city' => $_POST['city'],
                'country' => $_POST['country'],
                'artistId' => $_POST['artist_id'],
            );

            if($gigId = $this->gigmodel->addGig($params) > 0) {

                if($_POST['setlist_id'] != 0) {
            	   $this->setlistmodel->findSetList($_POST['setlist_id'], $gigId);
                } 

            	redirect($_SERVER['HTTP_REFERER']);
                
            } else {
            	die('Error please try again later');
            }
        } else {
            die('Could not add gig');
        }
    }

    public function addSetlist() {

        $gigId = $_POST['gig_id'];


        foreach ($_POST['tracks'] as $key => $value) {
            $order = $key + 1;
            $name = $value;

            if (!$item_id = $this->itemmodel->getItemByTrackName($name) > 0) {
                $item_id = 0;
            } 

            $data = array(
                'gig_id' => $gigId,
                'track_name' => $value,
                'item_id' => $item_id,
                'setlist_order' => $order,
                'item_id' => $item_id
            );

            $this->db->insert('setlist', $data);
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
}
