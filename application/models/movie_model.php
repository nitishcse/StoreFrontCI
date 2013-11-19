<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Movie_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get Total Movies by Category
     * @return type array
     */
    public function getTotalByCategory() {
        $query = $this->db->query('SELECT category.* , COUNT( movie.id ) AS total
FROM movie
LEFT JOIN category ON ( category.id = movie.catId
OR category.id = movie.subCatId ) 
GROUP BY category.id
LIMIT 0 , 30');

        return $query->result();
    }

    /**
     * Get Popular Movies
     * @return type array
     */
    public function getPopularMovie() {
        $this->db->limit(10);
        $this->db->order_by('id', 'RANDOM');
        $this->db->group_by('groupId');
        $query = $this->db->get('movie');

        return $query->result();
    }

    /**
     *  Search Movies
     * @param type $term
     * @return type array
     */
    public function searchMovie($term) {
        $this->db->like('title', $term);
        $this->db->group_by('groupId');
        $query = $this->db->get('movie');

        return $query->result();
    }

    /**
     * Get Movies By Category
     * @param type $catId
     * @param type $subCatId
     * @return type array
     */
    public function getMovieByCategory($catId, $subCatId) {
        if ($subCatId) {
            $this->db->where('subCatId', $subCatId);
        }
        if ($catId) {
            $this->db->where('catId', $catId);
        }
        //$this->db->group_by('groupId');
        $query = $this->db->get('movie');

        return $query->result();
    }

    /**
     * Validate Category and Sub Category Id
     * @param type $catId
     * @param type $subCatId
     * @return type boolean
     */
    public function validateCategory($catId, $subCatId) {
        if ($subCatId) {
            $this->db->where('id', $subCatId);
            $this->db->where('parent', $catId);
        } else {
            $this->db->where('id', $catId);
            $this->db->where('parent', NULL);
        }
        $query = $this->db->get('category');

        return ($query->num_rows() == 1) ? true : false;
    }

    /**
     * Get Movie Detail By Product Id
     * @param type $id
     * @return type array
     */
    public function getMovie($id) {
        $this->db->where('productId', $id);
        $query = $this->db->get('movie');

        return $query->row();
    }

    /**
     * Get All Version of a Group
     * @param type $groupId
     * @return type array
     */
    public function getOtherVersionMovie($id , $groupId) {
        $this->db->where('id !=', $id);
        $this->db->where('groupId', $groupId);
        $query = $this->db->get('movie');

        return $query->result();
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */