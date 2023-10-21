<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function viewRooms()
    {
        view('pages.master.view-rooms');
    }
}
