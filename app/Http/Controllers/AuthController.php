<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;


class AuthController extends BaseController
{
    private $request;
    public function __construct(Request $request){
        $this->request = $request;
    }

    protected function jwt(User $user){
        $payload = [
            'iss' => "lumen-jwt",
            'sub' => $user->id,
            'iat' => time(),
            'exp' => time() + 60*60
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    }

    public function authenticate(User $user){
        $this->validate($this->request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $this->request->input('email'))->first();
        if(!$user){
            return response()->json([
                'eror' => 'Email does not exist.'
            ], 400);
        }

        if(Hash::check($this->request->input('password'), $user->password)) {
            return response()->json([
                'token' => $this->jwt($user)
            ], 200);

            return response()->json([
                'eror' => 'Email or password is wrong.'
            ], 400);
        }
    }

    public function register(Request $request) {
        $this->validate($request, [
            'name' => 'required|string',
            'email'=> 'required|email|unique:user',
            'password'=> 'required|confirmed',
        ]);
    
        try {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);
    
            $user->save();
    
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'User Registration Failed'], 409);
            }
        }
    
    public function show($id)
    {
        $film = User::find($id);
        return response()->json($film);
    }

    public function update(Request $request, $id)
    {
        $film=User::find($id);
        $film->update($update->all());

        return response()->json([
            'message' => 'Successfull update film'
        ]);
    }

    public function delete($id) {
        User::destroy($id);
    
        return response()->json([
        'message' => 'Successfull delete Film'
        ]);
    }}
    