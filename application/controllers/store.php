<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Store extends CI_Controller {

    /**
     * Home Page
     */
    public function index() {
        $this->load->model('Movie_model');

        $data = array();
        $data['popular'] = $this->Movie_model->getPopularMovie();

        $this->_getCategory($data);

        $data['selectedCatId'] = NULL;
        $data['selectedSubCatId'] = NULL;

        $data['content'] = $this->load->view('home', $data, true);
        $this->load->view('template', $data);
    }

    /**
     * Category Page
     * @param type $catId
     * @param type $subCatId
     */
    public function category($catId = NULL, $subCatId = NULL) {
        $this->load->model('Movie_model');

        $status = $this->Movie_model->validateCategory($catId, $subCatId);

        if (!$status) {
            show_404();
        }
        $data = array();
        $this->_getCategory($data);
        $data['selectedCatId'] = $catId;
        $data['selectedSubCatId'] = $subCatId;

        $data['movieList'] = $this->Movie_model->getMovieByCategory($catId, $subCatId);

        $data['content'] = $this->load->view('cateogry-list', $data, true);
        $this->load->view('template', $data);
    }

    /**
     * Movie Detail Page
     * @param type $id
     */
    public function movie($id = NULL) {
        $this->load->model('Movie_model');

        $movie = $this->Movie_model->getMovie($id);

        if (!$movie) {
            show_404();
        }
        $data = array();
        $this->_getCategory($data);

        $data['selectedCatId'] = $movie->catId;
        $data['selectedSubCatId'] = $movie->subCatId;

        $data['movie'] = $movie;
        $data['otherVersion'] = $this->Movie_model->getOtherVersionMovie($movie->id, $movie->groupId);

        $data['content'] = $this->load->view('movie', $data, true);
        $this->load->view('template', $data);
    }

    /**
     * Search Page
     */
    public function search() {
        $this->load->model('Movie_model');

        $term = $this->input->get('term');
        if (!$term) {
            redirect('store/index');
        }

        $data = array();
        $data['search'] = $this->Movie_model->searchMovie($term);

        $this->_getCategory($data);

        $data['selectedCatId'] = NULL;
        $data['selectedSubCatId'] = NULL;

        $data['content'] = $this->load->view('search', $data, true);
        $this->load->view('template', $data);
    }

    /**
     * Get and Set Category List
     * @param type $data
     */
    private function _getCategory(&$data) {
        $data['category'] = $this->Movie_model->getTotalByCategory();

        $category = array();
        $AllCategory = array();
        foreach ($data['category'] as $cat) {
            if ($cat->parent == NULL) {
                $category[$cat->id] = array();
                $subCategory[$cat->id] = array();
                $category[$cat->id] = $cat;
            } else {
                $subCategory[$cat->parent][] = $cat;
            }
            $AllCategory[$cat->id] = $cat;
        }

        $data['parentCategory'] = $category;
        $data['subCategory'] = $subCategory;
        $data['allCategory'] = $AllCategory;
    }

}

/* End of file store.php */
/* Location: ./application/controllers/store.php */