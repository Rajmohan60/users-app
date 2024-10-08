<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;



class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            return redirect()->route($user->role == 2 ? 'user_list' : 'home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function home()
    {
        return view('home');
    }

    public function index()
    {
        $users = User::all();
        return view('user_list', compact('users'));
    }

    public function create()
    {
        return view('create_user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'dob' => 'nullable|date',
            'password' => 'required|min:8',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'dob' => $request->dob,
            'password' => bcrypt($request->password),
            'role' => 1,
        ]);

        return redirect()->route('user_list')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,' . $id,
            'dob' => 'nullable|date',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->dob = $request->dob;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('user_list')->with('success', 'Profile updated successfully');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user_list')->with('success', 'User deleted successfully');
    }

    public function showProfile($id)
    {
        $profile = User::findOrFail($id);
        return view('profile', compact('profile'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }


    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function showUpdateProfileForm()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('update_profile', compact('user')); // Pass user data to the view
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user = Auth::user(); // Get the currently authenticated super admin user
        $user->email = $request->email; // Update email

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // Update password if provided
        }

        $user->save(); // Save changes

        return redirect()->route('user_list')->with('success', 'Profile updated successfully');
    }


}
