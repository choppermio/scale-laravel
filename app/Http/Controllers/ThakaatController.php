<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreThakaatRequest;
use App\Http\Requests\UpdateThakaatRequest;
use App\Models\Thakaat;
use App\Models\ThakaatAnswer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ThakaatResult;

class ThakaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('scale.thakaat');
    }


    public function storeAnswers(Request $request)
    {
        $answers = $request->input('answers');
        // dd($answers);
//last testanswer where user_id
$lastTest = ThakaatAnswer::where('user_id', Auth::id())->orderBy('test_number', 'desc')->first();
$testNumber = $lastTest ? $lastTest->test_number + 1 : 1;
    foreach ($answers as $answer) {
        ThakaatAnswer::create([
            'test_number' => $testNumber,
            'question_id' => $answer['question_id'],
            'answer' => $answer['answer'],
            'user_id' => Auth::id(), // assuming you're saving the user's ID
        ]);
    }

    return response()->json(['message' => 'Answers saved successfully!'], 200);
    }



    public function storeResults(Request $request)
    {
        $validatedData = $request->validate([
            'results' => 'required|array',
            'results.*.category' => 'required|string',
            'results.*.score' => 'required|integer',
            'results.*.percentage' => 'required|numeric',
        ]);

        $lastTest = ThakaatResult::where('user_id', Auth::id())->orderBy('test_number', 'desc')->first();

        $testNumber = $lastTest ? $lastTest->test_number + 1 : 1;
        // dd($testNumber);

        foreach ($validatedData['results'] as $result) {
            ThakaatResult::create([
                'user_id' => Auth::id(),
                'test_number' => $testNumber,
                'category' => $result['category'],
                'score' => $result['score'],
                'percentage' => $result['percentage'],
            ]);
        }

        return response()->json(['message' => 'Results saved successfully.'], 200);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThakaatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Thakaat $thakaat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thakaat $thakaat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThakaatRequest $request, Thakaat $thakaat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thakaat $thakaat)
    {
        //
    }
}
