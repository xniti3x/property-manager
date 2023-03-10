<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vertrag extends Admin_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('mdl_vertrag');
        $this->load->library('session');
    }

    public function index() { 
        $data['vertrags'] = $this->mdl_vertrag->getAll();
        $this->layout->buffer('content', 'vertrag/index',$data);
        $this->layout->render();
    }

    public function addVertrag($id=null) {

        $this->layout->buffer('content', 'vertrag/add-vertrag',array("client_id"=>$id));
        $this->layout->render();
    }

    public function addVertragPost() {
        $data['vermieter'] = $this->input->post('vermieter');
        $data['client_id'] = $this->input->post('client_id');
        $data['stockwerk'] = $this->input->post('stockwerk');
        $data['wohnfleche'] = $this->input->post('wohnfleche');
        $data['wohnzweck'] = $this->input->post('wohnzweck');
        $data['adresse'] = $this->input->post('adresse');
        $data['raumlichkeiten'] = $this->input->post('raumlichkeiten');
        $data['kaltmiete'] = $this->input->post('kaltmiete');
        $data['nebenkosten'] = $this->input->post('nebenkosten');
        $data['iban'] = $this->input->post('iban');
        $data['kaution'] = $this->input->post('kaution');
        $data['kautionart'] = $this->input->post('kautionart');
        $data['begin'] = $this->input->post('begin');
        $data['ende'] = $this->input->post('ende');
        $data['selbstbeteiligung'] = $this->input->post('selbstbeteiligung');
        $last_id=$this->mdl_vertrag->insert($data);
        redirect('vertrag/viewVertrag/'.$last_id);
    }

    public function editVertrag($vertrag_id) {
        $data['vertrag_id'] = $vertrag_id;
        $data['vertrag'] = $this->mdl_vertrag->getDataById($vertrag_id);
       
        $this->layout->buffer('content', 'vertrag/edit-vertrag', $data);
        $this->layout->render();
    }

    public function editVertragPost() {
        $vertrag_id = $this->input->post('vertrag_id');
        $vertrag = $this->mdl_vertrag->getDataById($vertrag_id);
        $data['vermieter'] = $this->input->post('vermieter');
        $data['stockwerk'] = $this->input->post('stockwerk');
        $data['mieter'] = $this->input->post('mieter');
        $data['wohnfleche'] = $this->input->post('wohnfleche');
        $data['wohnzweck'] = $this->input->post('wohnzweck');
        $data['adresse'] = $this->input->post('adresse');
        $data['raumlichkeiten'] = $this->input->post('raumlichkeiten');
        $data['kaltmiete'] = $this->input->post('kaltmiete');
        $data['nebenkosten'] = $this->input->post('nebenkosten');
        $data['iban'] = $this->input->post('iban');
        $data['kaution'] = $this->input->post('kaution');
        $data['kautionart'] = $this->input->post('kautionart');
        $data['begin'] = $this->input->post('begin');
        $data['ende'] = $this->input->post('ende');
        $data['selbstbeteiligung'] = $this->input->post('selbstbeteiligung');
        $edit = $this->mdl_vertrag->update($vertrag_id,$data);
        if ($edit) {
            $this->session->set_flashdata('success', 'Vertrag Updated');
            redirect('vertrag/index');
        }
    }

    public function viewVertrag($vertrag_id) {
        $data = $this->mdl_vertrag->getDataById($vertrag_id);
        $client=$this->db->where('client_id', $data->client_id)->get('ip_clients')->row();

        $this->load->view('vertrag/view-vertrag', array("vertrag"=>$data,"client"=>$client));
    }

    public function delVertrag($vertrag_id) {
        $delete = $this->mdl_vertrag->delete($vertrag_id);
        $this->session->set_flashdata('success', 'vertrag deleted');
        redirect('vertrag/index');
    }
}