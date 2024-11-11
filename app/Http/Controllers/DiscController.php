<?php

namespace App\Http\Controllers;

use App\Models\DiscAnswer;
use App\Models\DiscResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscController extends Controller
{
    public function index(){
        return view('scale.disc');
    }


    public function submitDiscAnswers(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'answers' => 'required|array',
            'answers.*.question' => 'required|string',
            'answers.*.value' => 'required|string',
        ]);

        
$lastTest = DiscAnswer::where('user_id', Auth::id())->orderBy('test_number', 'desc')->first();
$testNumber = $lastTest ? $lastTest->test_number + 1 : 1;
        // Loop through the answers and save them to the database
        // dd($request->answers);
        foreach ($request->answers as $answer) {
            DiscAnswer::create([
                'question_number' => $answer['question'],
                'value_checked' => $answer['value'],
                'test_number'=> $testNumber,
                'user_id' => Auth::id() ? Auth::id() : 1,
            ]);
        }

        return response()->json(['message' => 'Answers submitted successfully!']);
    }



    public function discStoreResult(Request $request)
    {
        return 'fsadfasd';
        // Validate the incoming request
        $request->validate([
            'sorted_names' => 'required|array',
            'user_id' => 'required|exists:users,id', // Validate user_id
           
        ]);
        $user_id = $request->user_id;
        $lastTest = DiscAnswer::where('user_id', $user_id)->orderBy('test_number', 'desc')->first();
        $testNumber = $lastTest ? $lastTest->test_number  : 1;
        // Store the sorted names in the database
        DiscResult::create([
            'user_id' =>$user_id ? $user_id : 1,
            'test_number' => $testNumber,
            'results' => json_encode($request->sorted_names), // Store as JSON
        ]);

        return response()->json(['message' => 'Sorted names stored successfully!']);
    }
}
