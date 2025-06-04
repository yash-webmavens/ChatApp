<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '<>', auth()->id())
            ->withCount('unreadMessages')
            ->get();
        return view('dashboard', compact('users'));
    }

    public function show(int $receiverId)
    {
        return view('chat', compact('receiverId'));
    }
}
