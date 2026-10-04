<?php

namespace App\Controllers;

use App\Models\UserModel;

class HomeController extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();

        $stats = [
            'total'     => $userModel->countAllResults(),
            'aktif'     => $userModel->where('is_active', 1)->countAllResults(),
            'admin'     => $userModel->where('role', 'admin')->countAllResults(),
            'bulanIni'  => $userModel->where('created_at >=', date('Y-m-01 00:00:00'))->countAllResults(),
        ];

        return view('home/dashboard', [
            'title'       => 'Dashboard',
            'stats'       => $stats,
            'recentUsers' => $userModel->orderBy('created_at', 'DESC')->findAll(5),
        ]);
    }
}
