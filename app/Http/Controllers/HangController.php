<?php

namespace App\Http\Controllers;

use App\Hang;
use Illuminate\Http\Request;

class HangController extends Controller
{
    private static $hint;
    private static $length;
    private static $answer;

    public function index()
    {
        // get a random number between 1 and 10
        $random = rand(1, 10);
        $hang = Hang::find($random);
        self::$hint = $hang->hint;

        return response()->json([
            'hang' => $hang->hint,
            'length' => $hang->length
        ]);
    }

    public function store(Request $request)
    {
        $answer_length = strlen($request->get('answer'));
        $hang = new Hang([
            'hint' => $request->get('hint'),
            'answer' => $request->get('answer'),
            'length' => $answer_length
        ]);

        $hang->save();
        return response()->json([
            'message' => 'Hang created!'
        ]);
    }

    public function show($letter)
    {
        $answer_from_bd = Hang::where('hint', self::$hint)->first()->answer;

        // check if the letter is in the answer, if it is, return the answer with the letter where it should be and the other letters as underscores
        $answer = "";
        for ($i = 0; $i < strlen($answer_from_bd); $i++) {
            if ($answer_from_bd[$i] == $letter) {
                $answer .= $letter;
            } else {
                $answer .= "_";
            }
        }

        self::$answer = $answer;

        // check if the answer does not contain underscores, if it does not, return "you win", otherwise return the answer
        if (strpos($answer, "_") === false) {
            return response()->json([
                'message' => 'You win!',
                'answer' => $answer
            ]);
        }

        return response()->json([
            'answer' => $answer
        ]);
    }

    public function update(Request $request, $id)
    {
        return response()->json([
            'message' => 'Hang ' . $id . ' updated!'
        ]);
    }

    public function destroy($id)
    {
        return response()->json([
            'message' => 'Hang ' . $id . ' deleted!'
        ]);
    }
}
