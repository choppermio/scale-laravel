<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DiscAnswer;
use App\Models\DiscResult;
use App\Models\HollandPersona;
use App\Models\HollandTestResult;
use App\Models\ResultsStore;
use App\Models\School;
use App\Models\ThakaatResult;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class UserAuthController extends Controller
{
    public function schools(){
        return School::where('school_group_id', (int)$_GET['id'] )->get();
             

    }
    public function register(Request $request)
    {
        // return 'register';
        // Validate the incoming request data
        $registerUserData = $request->validate([
            'name' => 'required|string',
            // 'email' => 'required|string|email|unique:users',
            'school'=> 'required',
            // 'password' => 'required|min:8',
            'gender' => 'required|string|in:male,female', // Validate gender
            'id_number' => 'required|string|unique:users', // Validate id_number
            'mobile' => 'required|string|unique:users', // Validate mobile
        ]);
        // return $request->email;
    
        // Create a new user with the validated data
        $user = User::create([
            'name' => $registerUserData['name'],
            'email' =>  $request->email,
            'school_id' => $registerUserData['school'],
            'password' => Hash::make('123456'),
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
        DiscResult::where('user_id', $request->user_id)->delete();
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
            'top_direction' => $request->top,
            'right_direction' => $request->right,
            'left_direction' => $request->left,
            'bottom_direction' => $request->bottom,
        ]);

        return response()->json(['message' => 'Sorted names stored successfully!']);
    }






    public function storeHolland(Request $request)
    {

       
        HollandPersona::where('user_id', $request->user_id)->delete();

        try {
            // DB::beginTransaction();

            // $data = $request->validate([
            //     'user_id' => 'required|exists:users,id',
            //     'results' => 'required|array',
            //     'results.*.question_number' => 'required|integer',
            //     'results.*.question_text' => 'required|string',
            //     'results.*.category' => 'required|string',
            //     'results.*.answer' => 'required|integer',
            // ]);


            // $categoryScores = [
            //     'R' => 0, 'I' => 0, 'A' => 0,
            //     'S' => 0, 'E' => 0, 'C' => 0
            // ];
            // $last_test_result = HollandTestResult::where('user_id', auth()->id())->orderBy('id', 'desc')->first();
            // $last_test_id = $last_test_result ? $last_test_result->test_number + 1 : 1;
            // foreach ($data['results'] as $result) {
            //     HollandTestResult::create([
            //         'user_id' => $data['user_id'],
            //         'question_number' => $result['question_number'],
            //         'question_text' => $result['question_text'],
            //         'category' => $result['category'],
            //         'answer' => $result['answer'],
            //         'test_number'=>$last_test_id
            //     ]);

            //     $categoryScores[$result['category']] += $result['answer'];
            // }

            // arsort($categoryScores);
            // $topThree = array_slice($categoryScores, 0, 3, true);

            // $keys = array_keys($topThree);
            // $values = array_values($topThree);
            $hollandPersonaCount = HollandPersona::where('user_id', $request->user_id)->count();
            if ($hollandPersonaCount > 0) {
                return response()->json(['message' => 'Successful!']);
            }
                    HollandPersona::create([
                'user_id' => $request->user_id,
                'first_type' =>$request->first_type,
                'first_score' => $request->first_score,
                'second_type' => $request->second_type,
                'second_score' => $request->second_score,
                'third_type' => $request->third_type,
                'third_score' => $request->third_score,
            ]);

            // DB::commit();

            return response()->json([
                'message' => 'Results saved successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error('Error saving Holland test results: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving the results'], 500);
        }
    }


    public function storeThakaatResults(Request $request)
    {

        ThakaatResult::where('user_id', $request->user_id)->delete();

        $validatedData = $request->validate([
            'results' => 'required|array',
           
        ]);

        if(ThakaatResult::where('user_id', $request->user_id)->count() > 0){
            return response()->json(['message' => 'You have already taken the test']);
        }
        $lastTest = ThakaatResult::where('user_id', $request->user_id)->orderBy('test_number', 'desc')->first();

        $testNumber = $lastTest ? $lastTest->test_number + 1 : 1;
        // dd($testNumber);

        foreach ($validatedData['results'] as $key => $value) {
            ThakaatResult::create([
                'user_id' => $request->user_id,
                'test_number' => $testNumber,
                'category' => $value['letter'],
                'score' => $value['value'],
                'percentage'=>($value['value'] / 80) * 100
                // 'percentage' => $result['percentage'],
            ]);
        }

        return response()->json(['message' => 'Results saved successfully.'], 200);
    }


    public function getLastDiscResult(Request $request)
    {
        // Ensure the user is authenticated via Sanctum
        $user_id = $request->user_id;
    
        // Fetch the last DiscResult record for the given user_id
        // return ($user_id);
        $lastDiscResult = DiscResult::where('user_id', $user_id)->orderBy('created_at', 'desc')->first();
    
        if ($lastDiscResult) {
            return response()->json([
                'last_disc_result' => $lastDiscResult,
                'created_at' => $lastDiscResult->created_at,
                'top_direction' => $lastDiscResult->top_direction,
                'right_direction' => $lastDiscResult->right_direction,
                'left_direction' => $lastDiscResult->left_direction,
                'bottom_direction' => $lastDiscResult->bottom_direction,
            ]);
            } else {
            return response()->json(['message' => 'No results found'], 404);
        }
    }


    public function getHollandResults(Request $request)
    {
        $user_id = $request->user_id;
        $hollandResults = HollandPersona::where('user_id', $user_id)->get();
        $hollandResults = [
            ['letter' => $hollandResults[0]->first_type, 'value' => $hollandResults[0]->first_score],
            ['letter' => $hollandResults[0]->second_type, 'value' => $hollandResults[0]->second_score],
            ['letter' => $hollandResults[0]->third_type, 'value' => $hollandResults[0]->third_score],
        ];
    
        // Format the results
        $formattedResults = array_map(function($result) {
            return [
                'letter' => $result['letter'],
                'value' => $result['value']
            ];
        }, $hollandResults);
        $hollandResults2 = HollandPersona::where('user_id', $user_id)->first();
        $created_at = $hollandResults2->created_at;
        // return $created_at;
        // return $hollandResults2;

        return response()->json(['holland_results' => $formattedResults,'created_at' => $created_at]);  
      }



      public function resultStore(Request $request){
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            // 'results' => 'required|array', // Ensure results is JSON data
        ]);
    
        // Convert the results to JSON
        $resultsJson = json_encode($request['results']);
    
        // Update if user_id exists, insert otherwise
        ResultsStore::updateOrCreate(
            ['user_id' => $data['user_id']], // Search criteria
            ['results' => $resultsJson]     // Data to insert or update
        );
    
      }

        public function getResults(Request $request){
            $user_id = $request->user_id;
    
            // Retrieve the latest results for the user
            $results = ResultsStore::where('user_id', $user_id)->first();
            return $results;
    
            if ($results) {
        
               
        
                return response()->json(['results' => $results]);
    
            } else {
                return 0;
            }

        }
    public function getThakaatResults(Request $request){
        $user_id = $request->user_id;

        // Retrieve the latest thakaat_result for the user
        $thakaatResult = ThakaatResult::where('user_id', $user_id)->get();

        if ($thakaatResult) {
      
            $formattedResults = $thakaatResult->map(function($result) {
                return [
                    'id' => $result->id,
                    'user_id' => $result->user_id,
                    'score' => $result->score,
                    'category' => $result->category,
                    'created_at' => $result->created_at,
                    'updated_at' => $result->updated_at,
                ];
            });
    
            return response()->json(['thakaat_result' => $formattedResults]);

        } else {
            return response()->json(['message' => 'No thakaat result found for this user'], 404);
        }
    }


}
