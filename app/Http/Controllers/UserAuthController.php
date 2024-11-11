<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DiscAnswer;
use App\Models\DiscResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserAuthController extends Controller
{
    
    public function register(Request $request)
    {
        // return 'register';
        // Validate the incoming request data
        $registerUserData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
            'gender' => 'required|string|in:male,female', // Validate gender
            'id_number' => 'required|string|unique:users', // Validate id_number
            'mobile' => 'required|string|unique:users', // Validate mobile
        ]);
    
        // Create a new user with the validated data
        $user = User::create([
            'name' => $registerUserData['name'],
            'email' => $registerUserData['email'],
            'password' => Hash::make($registerUserData['password']),
            'gender' => $registerUserData['gender'], // Add gender
            'id_number' => $registerUserData['id_number'], // Add id_number
            'mobile' => $registerUserData['mobile'], // Add id_number
        ]);
    
        // Return a JSON response with a success message and user data
        return response()->json([
            'message' => 'User Created',
            'user' => $user, // Optionally return the created user data
        ]);
    }


    public function login(Request $request)
{
    // Validate the incoming request data
    $loginUserData = $request->validate([
        'id_number' => 'required|string',
        'mobile' => 'required|string|min:10',
    ]);

    // Find the user by id_number
    $user = User::where('id_number', $loginUserData['id_number'])->first();

    // Check if the user exists and the mobile number matches
    if (!$user || $user->mobile !== $loginUserData['mobile']) {
        return response()->json([
            'message' => 'Invalid Credentials'
        ], 401);
    }

    // Create a new token for the user
    $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;

    // Return the token in the response
    return response()->json([
        'access_token' => $token,
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'id_number' => $user->id_number,
        'mobile' => $user->mobile,
    ]);
}

    public function logout(){
        auth()->user()->tokens()->delete();
    
        return response()->json([
          "message"=>"logged out"
        ]);
    }


    public function discStoreResult(Request $request)
    {
        // Validate the incoming request
        // $request->validate([
        //     'sorted_names' => 'required|array',
        //     // 'user_id' => 'required|exists:users,id', // Validate user_id
        // ]);

$countdiscresult = DiscResult::where('user_id', $request->user_id)->count();
if($countdiscresult > 0){
    return response()->json(['message' => 'You have already taken the test']);
}
        $user_id = $request->user_id;
        $lastTest = DiscAnswer::where('user_id', $user_id)->orderBy('test_number', 'desc')->first();
        $testNumber = $lastTest ? $lastTest->test_number + 1 : 1; // Increment test number if last test exists

        // Store the sorted names in the database
        DiscResult::create([
            'user_id' => $user_id,
            'test_number' => $testNumber,
            'results' => json_encode($request->sorted_names), // Store as JSON
        ]);

        return response()->json(['message' => 'Sorted names stored successfully!']);
    }
}
