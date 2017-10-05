<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profil_model extends MY_Model
{
    protected $_table = "espel_profil";
    protected $primary_key = "nokp";

    protected $belongs_to = [
        'carta_l' => [
            'model' => 'hrmis_carta_model',
            'primary_key'=>'buid',
        ],
    ];

    protected $has_many = [
        'peranan_l' => [
            'model' => 'kumpulan_profil_model',
            'primary_key'=>'profil_nokp',
        ],
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function getProfil($username)
    {
        $this->load->model("kumpulan_model", "kumpulan");

        $profil = $this->get_by(["nokp"=>$username,"status"=>'Y']);

        return $profil;
    }

    public function all_profil($limit, $start, $filter)
    {
        $this->load->model('hrmis_carta_model', 'hrmis_carta');

        $all_jabatan = $this->hrmis_carta->as_array()->get_all();

        $sql = 'SELECT
            espel_profil.nokp,
            espel_profil.nama,
            espel_profil.gred_id,
            espel_profil.`status`,
            hrmis_skim.keterangan AS skim,
            hrmis_kumpulan.keterangan AS kumpulan,
            hrmis_carta_organisasi.title AS jabatan
            FROM
            espel_profil
            INNER JOIN hrmis_carta_organisasi ON espel_profil.jabatan_id = hrmis_carta_organisasi.buid
            INNER JOIN hrmis_kumpulan ON espel_profil.kelas_id = hrmis_kumpulan.kod
            INNER JOIN hrmis_skim ON hrmis_skim.kod = espel_profil.skim_id
            WHERE
            espel_profil.`status` = \'Y\' AND
            espel_profil.nokp <> \'admin\'';

            if($filter['nama'])
                $sql .= ' AND espel_profil.nama like \'' . $filter['nama'] . '\'';

            if($filter['jabatan_id'] and $filter['sub_jabatan'])
            {
                $sql .= ' AND espel_profil.jabatan_id in (' . implode(",", relatedJabatan($all_jabatan,$filter['jabatan_id'])) . ')';
            }
            else
            {
                $sql .= ' AND espel_profil.jabatan_id in (' . $filter['jabatan_id'] . ')';
            }

            if($filter['kump_id'])
                $sql .= ' AND espel_profil.kelas_id like \'' . $filter['kelas_id'] . '\'';

            if($filter['skim_id'])
                $sql .= ' AND espel_profil.skim_id like \'' . $filter['skim_id'] . '\'';

            if($filter['gred_id'])
                $sql .= ' AND espel_profil.gred_id like \'' . $filter['gred_id'] . '\'';

            $sql .= ' LIMIT ' . $start . ', ' . $limit;
        
        return $this->db->query($sql)->result();
    }

    public function sen_gred($kump)
    {
        $data = [];
        $sql = "select distinct gred_id from espel_profil where skim_id = ?";
        $sen_gred = $this->db->query($sql,[$kump])->result();

        foreach($sen_gred as $gred)
        {
            $data[]=['id' => $gred->gred_id,'kod' => $gred->gred_id];
        }

        return $data;
    }

    public function sen_skim($kump)
    {
        $data = [];
        $sql = "select distinct b.kod, b.keterangan
            from espel_profil a, hrmis_skim b
            where 1=1
            and a.skim_id = b.kod
            and a.kelas_id = ?";
        $sen_skim = $this->db->query($sql,[$kump])->result();

        foreach($sen_skim as $skim)
        {
            $data[]=['id' => $skim->kod,'kod' => $skim->keterangan];
        }

        return $data;
    }
}
