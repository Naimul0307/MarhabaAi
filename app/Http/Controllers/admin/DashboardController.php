<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index() {
        return view('admin.dashboard', [
            'meta_title' => 'ADMIN DASHBOARD | Marhaba AI',
            'meta_description' => 'MANAGE ADMIN SETTINGS AND DATA AT Marhaba AI.',
            'meta_keywords' => 'ADMIN DASHBOARD, Marhaba AI, EVENTS, ADMIN PANEL, Marhaba AI, DUBAI, UAE',
            'image_alt_text' => 'ADMIN DASHBOARD | Marhaba AI'
        ]);
    }
}
