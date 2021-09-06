<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Laravel\Passport\TokenRepository;
Use Redirect;

class AuthApiController extends Controller
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
            'password' => 'required|confirmed|min:8',
        ]);

        $dataUser = $request->all();

        $user = User::create([
            'name' => $dataUser['name'],
            'email' => $dataUser['email'],
            'password' => Hash::make($dataUser['password']),
        ]);
        return response(['message' => 'Inscription valide'], 204);
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
                    $token = $user->createToken('myToken')->accessToken;
                    $response = ['user' => $user, 'token' => $token];
                    return response($response, 200);
                }
            }
            else {
                $response = ["message" => "Not the good password"];
                return response($response, 422);
            }

        }
        else {
            $response = ["message" => "Your have no account, please create one in Inscription link"];
                return response($response, 422);
        }

    }
    public function logout(Request $request)
    {
        $tokenRepository = app(TokenRepository::class);
        $tokenRepository->revokeAccessToken('myToken');
        return response(['message' => 'You have been successfully logged out.'], 200);
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
        if ($user) {
            User::whereId($id)->update([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password'])
            ]);
            $response = ["message" => "Update ok"];
            return response($response, 204);
        }
        else {
            $response = ["message" => "Not OK"];
            return response($response, 400);
        }

    }
}
