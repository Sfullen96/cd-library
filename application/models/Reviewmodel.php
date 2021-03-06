<?php

class ReviewModel extends CI_Model
{
    function __construct() {
        parent::__construct();
    }

    function addReview($id, $review) {
        $data = array(
            'item_id' => $id,
            'user_id' => $this->session->userdata('user_id'),
            'review' => $review
        );

        $query = $this->db->insert('review', $data);

        if($query) {
            return true;
        } else {
            return false;
        }
    }

    function updateReview($id, $review) {
        $data = array(
            'review' => $review
        );

        $this->db->where('item_id', $id);
        $query = $this->db->update('review', $data);

        if($query) {
            return true;
        } else {
            return false;
        }
    }

    function getReview($item_id) {
        $query = $this->db->select()
            ->where('item_id', $item_id)
            ->get('review');

        return $query->result();
    }

    function doesItemHaveReview($item_id) {
        $query = $this->db->select()
            ->where('item_id', $item_id)
            ->get('review');

        if ($query->num_rows()) {
            return true;
        } else {
            return false;
        }
    }
}
 

