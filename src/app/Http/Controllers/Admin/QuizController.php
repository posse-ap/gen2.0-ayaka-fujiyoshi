<?php

namespace App\Http\Controllers\Admin;

use App\Models\BigQuestion;
use App\Models\Question;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    public function index()
    {
        $bigQuestions = BigQuestion::all();
        $questions = Question::all();
        return view('admin.quiz.index', compact('questions', 'bigQuestions'));
    }
}
