<?php

namespace App\Http\Controllers\Admin;

use App\Models\BigQuestion;
use App\Models\Question;
use App\Http\Controllers\Controller;

class BigQuestionController extends Controller
{
    public function index()
    {
        $bigQuestions = BigQuestion::all();
        $questions = Question::all();
        return view('admin.quiz.index', compact('questions', 'bigQuestions'));
    }

    public function create()
    {
      return view('admin.quiz.create');
    }

    public function edit()
    {
      return view('admin.quiz.edit');
    }

    public function store()
    {
      return redirect('admin.quiz.index');
    }

    public function delete()
    {
      return redirect('admin.quiz.index');
    }
}
