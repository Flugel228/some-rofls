<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(): \Illuminate\Contracts\View\Factory|
    \Illuminate\Foundation\Application|
    \Illuminate\Contracts\View\View|
    \Illuminate\Contracts\Foundation\Application
    {
        return view('admin.home');
    }
}
