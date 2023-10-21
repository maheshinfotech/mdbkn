<?php

namespace App\Http\Controllers;

use App\Models\RoleMenuPermission;

use Illuminate\Support\Facades\Gate;

use App\Models\Menu;


use App\Models\User;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        Gate::authorize('view', 'dashboard');

        return view('pages.dashboard');
    }
}
