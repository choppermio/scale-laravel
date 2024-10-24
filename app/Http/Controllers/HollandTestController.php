<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HollandTestResult;
use App\Models\HollandPersona;
use Illuminate\Support\Facades\DB;

class HollandTestController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validate([
                'user_id' => 'required|exists:users,id',
                'results' => 'required|array',
                'results.*.question_number' => 'required|integer',
                'results.*.question_text' => 'required|string',
                'results.*.category' => 'required|string',
                'results.*.answer' => 'required|integer',
            ]);

            $categoryScores = [
                'R' => 0, 'I' => 0, 'A' => 0,
                'S' => 0, 'E' => 0, 'C' => 0
            ];

            foreach ($data['results'] as $result) {
                HollandTestResult::create([
                    'user_id' => $data['user_id'],
                    'question_number' => $result['question_number'],
                    'question_text' => $result['question_text'],
                    'category' => $result['category'],
                    'answer' => $result['answer'],
                ]);

                $categoryScores[$result['category']] += $result['answer'];
            }

            arsort($categoryScores);
            $topThree = array_slice($categoryScores, 0, 3, true);

            $keys = array_keys($topThree);
            $values = array_values($topThree);

            HollandPersona::create([
                'user_id' => $data['user_id'],
                'first_type' => $keys[0],
                'first_score' => $values[0],
                'second_type' => $keys[1],
                'second_score' => $values[1],
                'third_type' => $keys[2],
                'third_score' => $values[2],
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Results saved successfully',
                'top_three' => $topThree
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error('Error saving Holland test results: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving the results'], 500);
        }
    }
}