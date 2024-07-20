<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Designation;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
      
        $search = $request->input('search', '');
        
        // Fetch users with optional search filter
        $users = User::with(['department', 'designation'])
                     ->when($search, function ($query, $search) {
                         return $query->where(function($q) use ($search) {
                             $q->where('name', 'like', "%{$search}%")
                               ->orWhere('phone_number', 'like', "%{$search}%")
                               ->orWhereHas('department', function($q) use ($search) {
                                   $q->where('name', 'like', "%{$search}%");
                               })
                               ->orWhereHas('designation', function($q) use ($search) {
                                   $q->where('name', 'like', "%{$search}%");
                               });
                         });
                     })
                     ->get();


                     if ($request->ajax()) {
                        return response()->json(['users' => $users]);
                    }

                    
        return view('welcome', compact('users'));
    }
}
