<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HollandTestResult;
use Illuminate\Support\Facades\Log;

class HollandTestController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'user_id' => 'required|exists:users,id',
                'results' => 'required|array',
                'results.*.question_number' => 'required|integer',
                'results.*.question_text' => 'required|string',
                'results.*.category' => 'required|string',
                'results.*.answer' => 'required|integer',
            ]);

            foreach ($data['results'] as $result) {
                HollandTestResult::create([
                    'user_id' => $data['user_id'],
                    'question_number' => $result['question_number'],
                    'question_text' => $result['question_text'],
                    'category' => $result['category'],
                    'answer' => $result['answer'],
                ]);
            }

            return response()->json(['message' => 'Results saved successfully']);
        } catch (\Exception $e) {
            Log::error('Error saving Holland test results: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving the results'], 500);
        }
    }
}