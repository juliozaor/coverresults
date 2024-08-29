<?php

namespace App\Http\Controllers;

use App\Models\Suspect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

use Carbon\Carbon;


class SuspectAuthController extends Controller
{
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:suspects',
            'password' => 'required|string|min:8',
            'identification' => 'required|integer',
            'date_dirth' => 'required|date',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'photo' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Procesa la carga de la imagen
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photoPath = 'upload/photos/' . $photoName;
            $photo->move(public_path('upload/photos'), $photoName);
        } else {
            $photoPath = null;
        }


        $suspect = Suspect::create([
            'user_id' => $request->user_id,
           // 'device_id' => $request->device_id,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'identification' => $request->identification,
            'date_dirth' => $request->date_dirth,
            'state' => $request->state,
            'city' => $request->city,
            'state_id' => 1,
            'city_id' => 1,
            'address' => $request->address,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'photo' => $photoPath
        ]);

        return response()->json(['message' => 'Suspect registered successfully', 'suspect' => $suspect]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
      

        try {
            if (!$token = auth('suspect')->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return $this->respondWithToken($token);
    }

    // Método para obtener el sospechoso autenticado
    public function suspect()
    {
        return response()->json(auth('suspect')->user());
    }

    public function logout()
    {

        try {
            auth('suspect')->logout();
            return response()->json(['message' => 'Successfully logged out']);
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token has expired'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token is invalid'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid or expired'], 401);
        }
    }

    // Método para refrescar el token
    public function refresh()
    {
         try {
            return $this->respondWithToken(auth('suspect')->refresh());
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token has expired'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Token is invalid'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid or expired'], 401);
        }
    }

    /* protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('suspect')->factory()->getTTL() * 60 * 24 * 30,
            'suspect' => auth('suspect')->user()
        ]);
    } */

    protected function respondWithToken($token)
{
     $expiresInMinutes = auth('suspect')->factory()->getTTL();
     $expirationDate = Carbon::now()->addMinutes($expiresInMinutes)->toDateString();
 
     return response()->json([
         'access_token' => $token,
         'token_type' => 'bearer',
         'expires_in' => $expirationDate, // Formato de solo fecha
         'suspect' => auth('suspect')->user()
     ]);
}

}
