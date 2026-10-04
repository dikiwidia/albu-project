<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();

        $users = [
            [
                'nama'      => 'Administrator',
                'email'     => 'admin@unilam.ac.id',
                'password'  => 'password', // di-hash otomatis oleh UserModel
                'role'      => 'admin',
                'is_active' => 1,
            ],
            [
                'nama'      => 'Albu',
                'email'     => 'albu@unilam.ac.id',
                'password'  => 'password',
                'role'      => 'user',
                'is_active' => 1,
            ],
        ];

        foreach ($users as $user) {
            // Lewati jika email sudah ada, supaya seeder aman dijalankan berulang kali
            if ($userModel->withDeleted()->where('email', $user['email'])->first() !== null) {
                echo "User {$user['email']} sudah ada, dilewati." . PHP_EOL;

                continue;
            }

            if (! $userModel->insert($user)) {
                echo "Gagal menambahkan {$user['email']}: " . implode(', ', $userModel->errors()) . PHP_EOL;

                continue;
            }

            echo "User {$user['email']} berhasil ditambahkan." . PHP_EOL;
        }
    }
}
