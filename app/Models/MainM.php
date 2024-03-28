<?php

namespace App\Models;

use CodeIgniter\Model;

class MainM extends Model
{
    protected $table            = 'main';
    protected $allowedFields    = ['tanggal', 'materi', 'kelas', 'mapel', 'jumlah', 'hadir', 'tidak_hadir', 'alasan', 'dokumentasi', 'keterangan'];
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'tanggal' => 'required',
        'materi' => 'required|max_length[150]',
        'kelas' => 'required|max_length[50]',
        'mapel' => 'required|max_length[150]',
        'jumlah' => 'required|max_length[3]',
        'hadir' => 'required|max_length[3]',
        'tidak_hadir' => 'required|max_length[3]',
        'alasan' => 'required|max_length[200]',
        'dokumentasi' => 'required',
        'keterangan' => 'required|max_length[200]',
    ];
    protected $validationMessages   = [
        'tanggal' => ['required' => 'tidak boleh kosong'],
        'materi' => ['required' => 'tidak boleh kosong', 'max_length' => 'Maximal 150 Karakter'],
        'kelas' => ['required' => 'tidak boleh kosong', 'max_length' => 'Maximal 50 Karakter'],
        'mapel' => ['required' => 'tidak boleh kosong', 'max_length' => 'Maximal 150 Karakter'],
        'jumlah' => ['required' => 'tidak boleh kosong', 'max_length' => 'Maximal 3 Karakter'],
        'hadir' => ['required' => 'tidak boleh kosong', 'max_length' => 'Maximal 3 Karakter'],
        'tidak_hadir' => ['required' => 'tidak boleh kosong', 'max_length' => 'Maximal 3 Karakter'],
        'alasan' => ['required' => 'tidak boleh kosong', 'max_length' => 'Maximal 200 Karakter'],
        'dokumentasi' => ['required' => 'tidak boleh kosong'],
        'keterangan' => ['required' => 'tidak boleh kosong', 'max_length' => 'Maximal 200 Karakter'],
    ];
}
