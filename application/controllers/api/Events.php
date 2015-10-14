<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Events extends REST_Controller {
	function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

	public function find_get()
    {
    	$id = $this->get('id');
        // If the id parameter doesn't exist return all the events
        if ($id === NULL)
        {
            $events = $this->db->get("events");
            $this->response($events, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $event = $this->db->get_where("events", array('id' => $id));
            if($event === NULL) {

	            $this->set_response([
	                'status' => FALSE,
	                'message' => 'User could not be found'
	            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code

            } else {
        		$this->response($event, REST_Controller::HTTP_OK);
            }
        }
    }
}