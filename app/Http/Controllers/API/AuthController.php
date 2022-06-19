<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Support\Facades\Storage;
use Twilio\Rest\Client;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $photo = $request->file('photo');

        if ($photo) {
            $fileName = time().'_'.$photo->getClientOriginalName();
            $filePath = $photo->storeAs('images/users', $fileName, 'public');
        }

        $phone_number = $request['phone_number'];
        if ($request['phone_number'][0] == "0") {
            $phone_number = substr($phone_number, 1);
        }

        if ($phone_number[0] == "8") {
            $phone_number = "62" . $phone_number;
        }


        $user = User::create([
            'photo'         => $filePath ?? null,
            'name'          => $request->name,
            'email'         => $request->email,
            'phone_number'  => $phone_number,
            'password'      => Hash::make($request->password)
         ]);

        $this->whatsappNotification($user->phone_number, $user->name);

        $user->notify(new WelcomeEmailNotification($user));

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    private function whatsappNotification($recipient, $userName)
    {
        $sid     = env("TWILIO_AUTH_SID");
        $token   = env("TWILIO_AUTH_TOKEN");
        $wa_from = env("TWILIO_WHATSAPP_FROM");
        $twilio  = new Client($sid, $token);
        
        $body = 'Halo Bapak/Ibu '.$userName.', akun aplikasi pemakaman disperkim cianjur Anda telah aktif!.';

        return $twilio->messages->create("whatsapp:+$recipient",[
                                        "from" => "$wa_from",
                                        "body" => $body
                                    ]);
    }

    // method for login
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['message' => 'Hi '.$user->name.', welcome to home','access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function profile()
    {
        
        return response()->json(['message' => 'Your Profile','data' => Auth::user()]);
    }

    // method for profile update
    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(),[
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password'  => 'nullable|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $photo = $request->file('photo');

        if ($photo) {
            Storage::delete('public/'.$user->photo);

            $fileName = time().'_'.$photo->getClientOriginalName();
            $filePath = $photo->storeAs('images/users', $fileName, 'public');
        }

        $phone_number = $request['phone_number'];
        if ($request['phone_number'][0] == "0") {
            $phone_number = substr($phone_number, 1);
        }

        if ($phone_number[0] == "8") {
            $phone_number = "62" . $phone_number;
        }

        $user->update([
            'photo'         => $filePath ?? $user->photo,
            'name'          => $request->name,
            'email'         => $request->email,
            'phone_number'  => $phone_number,
            'password'      => $request->password ? Hash::make($request->password) : $user->password
         ]);

         return response()->json(['message' => 'Successfully updated','data' => $user]);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'You have been logged out']);
    }
    public function me(Request $request)
    {
    return response()->json([
        'data' => $request->user(),
    ]);
    }
}