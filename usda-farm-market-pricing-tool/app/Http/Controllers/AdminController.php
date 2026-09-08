<?php

namespace App\Http\Controllers;

use App\Models\PriceEntry;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'userCount' => User::count(),
            'adminCount' => User::where('is_admin', true)->count(),
            'entryCount' => PriceEntry::count(),
            'recentEntries' => PriceEntry::with('user')->latest()->limit(10)->get(),
        ]);
    }

    public function users()
    {
        return view('admin.users', [
            'users' => User::withCount('priceEntries')->latest()->get(),
        ]);
    }

    public function entries()
    {
        return view('admin.entries', [
            'entries' => PriceEntry::with('user')->latest()->get(),
        ]);
    }
}