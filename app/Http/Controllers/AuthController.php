<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
Use Redirect;

class AuthController extends Controller
{
    public function create()
    {
        return view('subscribe');
    }
    public function store(Request $request)
    {
        $dataUser = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $dataUser = $request->all();

        $user = User::create([
            'name' => $dataUser['name'],
            'email' => $dataUser['email'],
            'password' => Hash::make($dataUser['password']),
        ]);
        return redirect("/")->withSuccess('You have signed-in');
    }
    public function login()
    {
        return view('welcome');
    }
    public function sessionStart(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user)
        {
            if (Hash::check($request->password, $user->password))
            {
                $credentials = $request->only('email', 'password');
                if (Auth::attempt($credentials)) {
                    return redirect()->intended('dashboard')
                                ->withSuccess('Signed in');
                }
            }
            else {
               return Redirect::back()->withErrors(
                [
                    'password' => 'Not the good password'
                ]
                );
            }

        }
        else {
            return Redirect::back()->withErrors(
                [
                    'name' => 'Your have no account, please create one in Inscription link'
                ]
                );
        }

    }
    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
    public function dashboard()
    {
        if(Auth::check()){
            $user = Auth::user();
            return View::make('dashboard')->with('name', $user->name);
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function show()
    {
        $user = Auth::user();
        return view('changeInformation',compact('user'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('changeInformation', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ]);
        User::whereId($id)->update([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($user['password'])
        ]);


        return redirect()->route('dashboard')
            ->with('success','User updated successfully');
    }
}
