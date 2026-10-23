<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index()
    {
        $users = User::where('company_id', Auth::user()->company_id)
            ->orderBy('name')
            ->get();

        return view('user.team.index', compact('users'));
    }

    public function show(User $user)
    {
        if ($user->company_id !== Auth::user()->company_id) abort(403);
        return view('user.team.show', compact('user'));
    }
}
