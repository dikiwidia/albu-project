<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;

class UserController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * READ - daftar user dengan pencarian & pagination.
     */
    public function index(): string
    {
        $keyword = trim((string) $this->request->getGet('q'));

        if ($keyword !== '') {
            $this->userModel->groupStart()
                ->like('nama', $keyword)
                ->orLike('email', $keyword)
                ->groupEnd();
        }

        $data = [
            'title'   => 'Users',
            'users'   => $this->userModel->orderBy('created_at', 'DESC')->paginate(10),
            'pager'   => $this->userModel->pager,
            'keyword' => $keyword,
        ];

        return view('users/index', $data);
    }

    /**
     * CREATE - tampilkan form tambah user.
     */
    public function create(): string
    {
        return view('users/form', [
            'title' => 'Tambah User',
            'user'  => null,
        ]);
    }

    /**
     * CREATE - simpan user baru.
     */
    public function store(): RedirectResponse
    {
        $rules = [
            'password_confirm' => [
                'rules'  => 'required|matches[password]',
                'errors' => ['matches' => 'Konfirmasi password tidak sama.'],
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Password di-hash otomatis oleh callback hashPassword di UserModel
        if (! $this->userModel->insert($this->collectData())) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        return redirect()->to('/users')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * UPDATE - tampilkan form edit user.
     */
    public function edit(int $id): string
    {
        return view('users/form', [
            'title' => 'Edit User',
            'user'  => $this->findOrFail($id),
        ]);
    }

    /**
     * UPDATE - simpan perubahan user.
     */
    public function update(int $id): RedirectResponse
    {
        $this->findOrFail($id);

        $data = $this->collectData();

        // Password opsional saat edit: kosong = tidak diubah
        if ($data['password'] === '') {
            unset($data['password']);
        } elseif (! $this->validate([
            'password_confirm' => [
                'rules'  => 'required|matches[password]',
                'errors' => ['matches' => 'Konfirmasi password tidak sama.'],
            ],
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // User yang sedang login tidak boleh menonaktifkan / menurunkan role dirinya sendiri
        if ($id === (int) session('user_id')) {
            $data['is_active'] = 1;
            $data['role']      = session('role');
        }

        // 'id' dibutuhkan placeholder {id} pada rule is_unique email
        $data['id'] = $id;

        if (! $this->userModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        // Sinkronkan data session jika user mengedit dirinya sendiri
        if ($id === (int) session('user_id')) {
            session()->set(['nama' => $data['nama'], 'email' => $data['email']]);
        }

        return redirect()->to('/users')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * DELETE - hapus user (soft delete, lihat $useSoftDeletes di UserModel).
     */
    public function delete(int $id): RedirectResponse
    {
        $user = $this->findOrFail($id);

        if ($id === (int) session('user_id') || session('role') != 'admin') {
            return redirect()->to('/users')->with('error', 'Anda tidak dapat menghapus akun sendiri atau Anda bukan Admin');
        }

        $this->userModel->delete($id);

        return redirect()->to('/users')->with('success', 'User ' . $user['nama'] . ' berhasil dihapus.');
    }

    /**
     * Ambil input form user.
     */
    private function collectData(): array
    {
        return [
            'nama'      => (string) $this->request->getPost('nama'),
            'email'     => (string) $this->request->getPost('email'),
            'password'  => (string) $this->request->getPost('password'),
            'no_hp'     => (string) $this->request->getPost('no_hp'),
            'role'      => (string) $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];
    }

    /**
     * Cari user berdasarkan id, tampilkan 404 jika tidak ditemukan.
     */
    private function findOrFail(int $id): array
    {
        $user = $this->userModel->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound('User tidak ditemukan.');
        }

        return $user;
    }
}
