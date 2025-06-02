<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginSuperAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('Auth.loginSuperAdmin');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Cek apakah user memiliki role super_admin
            if ($user->hasRole('super_admin')) {
                $request->session()->regenerate();
                return redirect()->intended('admin/dashboard');
            } else {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Anda tidak memiliki akses sebagai Super Admin.',
                ]);
            }
        }
        
        return back()->withErrors([
            'email' => 'Kredensial tidak valid.',
        ]);
    }
}