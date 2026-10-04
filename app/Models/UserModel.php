<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama',
        'email',
        'password',
        'no_hp',
        'foto',
        'role',
        'is_active',
        'last_login',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'id'       => 'permit_empty|is_natural_no_zero',
        'nama'     => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email|max_length[100]|is_unique[users.email,id,{id}]',
        'password' => 'required|min_length[8]',
        'no_hp'    => 'permit_empty|max_length[20]',
        'role'     => 'permit_empty|in_list[admin,user]',
    ];
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Email sudah terdaftar.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    /**
     * Hash password sebelum disimpan ke database.
     */
    protected function hashPassword(array $data): array
    {
        if (! empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['data']['password']);
        }

        return $data;
    }

    /**
     * Cari user aktif berdasarkan email.
     */
    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)
            ->where('is_active', 1)
            ->first();
    }

    /**
     * Verifikasi email & password. Mengembalikan data user jika valid, null jika tidak.
     */
    public function verifyLogin(string $email, string $password): ?array
    {
        $user = $this->findByEmail($email);

        // password_verify($password, $user['password'])
        // $password = itu dari atas / params = "password"
        // $user['password'] = "$2y$12$O5zRgM8lY28dqzq1BElao.hP1hLGzwGuWYheC0v337NDt4aCMGMzC"
        if ($user === null || ! password_verify($password, $user['password'])) {
            return null;
        }

        $this->update($user['id'], ['last_login' => date('Y-m-d H:i:s')]);

        return $user;
    }
}
