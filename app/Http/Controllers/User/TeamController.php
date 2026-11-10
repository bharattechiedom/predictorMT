<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index()
    {
        $users = User::where('company_id', Auth::user()->company_id)
            ->orderBy('name')
            ->paginate(12);
        $roleCounts = User::where('company_id', Auth::user()->company_id)
            ->selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role');

        return view('user.team.index', compact('users', 'roleCounts'));
    }

    public function show(User $user)
    {
        if ($user->company_id !== Auth::user()->company_id) {
            abort(403);
        }

        return view('user.team.show', compact('user'));
    }
}
