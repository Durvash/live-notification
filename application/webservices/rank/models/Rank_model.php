<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rank_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function rankList($id = '')
    {
        if (!empty($id) && is_numeric($id)) {
            $this->db->where('id', $id);
        }
        
        $this->db->select('id, rank_value AS value, rank');
        $this->db->order_by('rank_value', 'ASC');
        $res = $this->db->get('rank_data')->result_array();
        return $res;
    }

    public function updateRank($params)
    {
        $id = $params['id'];
        if(is_numeric($id))
        {
            unset($params['id']);
            $this->db->where('id', $id);
            $this->db->update('rank_data', $params);

            //// Update ranks according ascending value
            $res = $this->rankList();
            $updArr = [];
            foreach($res as $k => $val)
            {
                $updArr[] = array(
                    'id'            => $val['id'],
                    'rank_value'    => $val['value'],
                    'rank'          => $k + 1
                );
            }

            $this->db->update_batch('rank_data', $updArr, 'id');
        }
    }

    public function deleteUser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('rank_data');
    }
}