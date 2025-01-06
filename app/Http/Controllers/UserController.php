<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function view_admin()
    {
        $user = User::all();
        return view('admin.admin',['user'=>$user]);
    }

    public function create()
    {
        return view('admin/create_admin');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,pengunjung',
            
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role']
        ]);

        return redirect('admin')->with('success', 'Admin baru berhasil ditambahkan.');
    }


    public function aksi_login(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->route('blog.view_blog')->with('success', 'Login berhasil sebagai Admin.');
            } elseif (Auth::user()->role === 'pengunjung') {
                return redirect()->route('index')->with('success', 'Login berhasil sebagai Pengunjung.');
            }
        }
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function register()
    {
        return view('register');
    }

    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();
        return redirect('admin')->with('success','data berhasil dihapus');
    }
    

    public function edit($id)
    {
     
        $admin = User::findOrFail($id);
        return view('admin/edit_admin', compact('admin'));
    }

    public function login()
    {
        return view('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index')->with('success', 'Anda berhasil logout.');
    }

    public function update(Request $request, $id)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed', 
        ]);

        $admin = User::findOrFail($id);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];


        if ($request->filled('password')) {
            $admin->password = bcrypt($validated['password']);
        }

        $admin->save(); 

        return redirect()->route('admin.dashboard')->with('success', 'Admin berhasil diupdate.');
    }


}
