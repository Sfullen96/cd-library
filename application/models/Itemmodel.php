<?php

class ItemModel extends CI_Model
{

    public $user_id;

    function __construct() {
        parent::__construct();
        $this->user_id = ($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : 0;
    }

    function doesBelongToUser($id, $itemId) {
        $query = $this->db->select()
                ->where('user_id', $id)
                ->where('item_id', $itemId)
                ->get('item');

        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getItemInfo($itemId) {
        $query = $this->db->select()
                ->join('artist', 'artist.artist_id = item.artist_id')
                ->join( 'item_type', 'item_type.id = item.item_type' )
                ->join('format', 'format.format_id = item.format_id')
                ->where('item_id', $itemId)
                ->where('item.user_id', $this->user_id)
                ->get('item');

       return $query->result();

    }

    public function getRecentlyAdded() {
        $query = $this->db->select()
                ->join('artist', 'artist.artist_id = item.artist_id')
                ->where('item.user_id', $this->user_id)
                ->order_by('item.created_at DESC')
                ->limit(5)
                ->get('item');

        if($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getItemRating($itemId) {
        $rating = $this->db->select('rating')
                ->where('item_id', $itemId)
                ->get('item');

        return $rating->result();
    }

    function updateRating($rating, $itemId) {
        $data = array(
            'rating' => $rating
        );

        $this->db->where('item_id', $itemId);
        $this->db->update('item', $data);
    }

    function updateItem($field, $value, $table, $itemId) {
        $data = array(
            $field => $value
        );

        $this->db->where('item_id', $itemId);
        $query = $this->db->update($table, $data);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function getList($table) {
        $query = $this->db->get($table);

        return $query;
    }

    function getItemTypes() {
        $query = $this->db->select()
            ->where('id != 4')
            ->get( 'item_type' );

        return $query->result();
    }

    function addNewCd($title, $artist_id, $summary, $format_id, $reference, $cd_count, $image, $purchasedFrom, $purchaseDate, $price, $user_id, $itemType) {

        $data = array(
            'artist_id' => $artist_id,
            'format_id' => $format_id,
            'disc_count' => $cd_count,
            'title' => $title,
            'reference' => $reference,
            'purchase_date' => $purchaseDate,
            'purchased_from' => $purchasedFrom,
            'price' => $price,
            'summary' => $summary,
            'image' => $image,
            'user_id' => $user_id,
            'item_type' => $itemType,
        );

        $query = $this->db->insert('item', $data);

        return $this->db->insert_id();

    }

    function checkIfExists($name, $artist, $type, $format) {
        $query = $this->db->select()
                ->where('user_id', $this->session->userdata('user_id'))
                ->where('title', $name)
                ->where( 'item_type', $type )
                ->where('artist_id', $artist)
                ->where( 'format_id', $format )
                ->get('item');

        if($query->num_rows() > 0) {
            return $query->result()[0]->item_id;
        } else {
            return 0;
        }
    }

    function getAllitems() {
        $query = $this->db->select()
                ->join('artist', 'artist.artist_id = item.artist_id')
                ->join('format', 'format.format_id = item.format_id')
                ->where('item.user_id', $this->user_id)
                ->get('item');

       return $query->result();
    }

    function getItemByTrackName($name) {
        $query = $this->db->select('item_id')
                ->where('track_name', $name)
                ->get('track');

        if ($query->num_rows() > 0) {
            return $query->result()[0]->item_id;
        } else {
            return false;
        }

    }

    public function cdStats($timeframe) {
        switch ($timeframe) {
            case 'week':
                $day = date('w');

                if ($day == 1) {
                    // Monday 
                    $from = strtotime('today 12am');
                } else {
                    $from = strtotime('last monday midnight') + 1;
                }

                if ($day == 7) {
                    $to = strtotime('today 23:59:59');
                } else {
                    $to = strtotime('next sunday 23:59:59');
                }
                break;
            case 'month':
                $from = strtotime(date('Y-m-01'));
                $to = strtotime(date('Y-m-t'));
                break;
            case 'year':
                $year = date('Y');
                $from = mktime(0, 0, 0, 1, 1, $year);
                $to = mktime(0, 0, 0, 12, 31, $year);
                break;
            default:
                
                break;
        }
       
        $sql = "
            SELECT 
              * 
            FROM
              item 
            WHERE created_at BETWEEN FROM_UNIXTIME($from) 
            AND FROM_UNIXTIME($to)
            AND user_id = '$this->user_id'
        ";

        $query = $this->db->query($sql);
       

        return $query->num_rows();
    }

    function getCDcount( $userId = false ) {
        if ( !$userId ) {
            $userId = $this->user_id;
        }

        $query = $this->db->select()
                    ->where('user_id', $userId)
                    ->get('item');

        return $query->num_rows();
    }

    function getCDListenedCount( $userId = false ) {
        if ( !$userId ) {
            $userId = $this->user_id;
        }

        $query = $this->db->select()
                ->where('listened', 1)
                ->where('user_id', $userId)
                ->get('item');

        return $query->num_rows();
    }

    public function addView($id) {
        $data = array(
            'item_id' => $id,
            'user_id' => $this->session->userdata('user_id'),
        );

        $query = $this->db->insert('item_view', $data);

        if($query) {
            return true;
        } else {
            return false;
        }
    }

    public function getFavAlbums( $userId = false ) {
        if ( !$userId  ) {
            $id = $this->user_id;
        } else {
            $id = $userId;
        }

        $sql = "
            SELECT COUNT(view_id) as views, item_view.item_id, title, image, artist_name, artist.artist_id
            FROM item_view
            LEFT JOIN item 
            ON item.item_id = item_view.item_id
            LEFT JOIN artist
            ON artist.artist_id = item.artist_id
            WHERE item.user_id = '$id'
            GROUP BY item_view.item_id
            ORDER BY COuNT(view_id) DESC,
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

    public function getRecentlyViewed() {
        $id = $this->user_id;
        $sql = "
            SELECT *
            FROM item_view v
            LEFT JOIN item l
            ON l.item_id = v.item_id
            LEFT JOIN artist a
            ON a.artist_id = l.artist_id
            WHERE a.user_id = '$this->user_id'
            GROUP BY v.item_id
            ORDER BY timestamp DESC
            LIMIT 5
        ";

        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addListen($itemId) {
        $data = array(
            'item_id' => $itemId,
            'user_id' => $this->session->userdata('user_id'),
        );

        $query = $this->db->insert('item_listen', $data);

        if($query) {
            return true;
        } else {
            return false;
        }
    }
}
 

