<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Passport\Bridge\AccessTokenRepository;
use Carbon\Carbon;

class PassportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('Museum-'.$request->name)->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {

        if (strripos($request->user_id, '@') === false){
            $userId = 'name';
        } else
        {
            $userId = 'email';
        }

        $data = [
            $userId => $request->user_id,
            'password' => $request->password,
            'verified_user' => 1
        ];

        if (auth()->attempt($data)) {

            $tokenResult = auth()->user()->createToken('Museum-'.$request->user_id);
            $token = $tokenResult->accessToken;
            return response()->json(['token' => $token], 200);

        } else {

            return response()->json(['error' => 'Доступ закрыт'], 401);

        }
    }

    public function isValidToken(Request $request)
    {


        //$tokenRep = app(AccessTokenRepository::class);

        $tokenId = auth()->user()->token()->id;

        auth()->user()->token()->update();

        $tokenStr =trim(substr($request->header('Authorization'),strlen('Bearer')+1));

       // $tokenRep->revokeAccessToken($tokenId);


        return response()->json(['token' => $tokenStr,'data'=>auth()->user()->token()], 200);

    }

    public function reset(Request $request){
        $user = User::find(auth()->user()->id);

        $user->password = bcrypt($request->new_password);
        $user->save();

        return response()->json(['data'=>$user], 200);
    }
}
