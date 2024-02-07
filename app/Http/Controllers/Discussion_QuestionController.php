<?php

namespace App\Http\Controllers;

use App\Models\DiscussionQuestion;
use App\Models\User;
use Illuminate\Http\Request;

class Discussion_QuestionController extends Controller
{
    public function index()
    {
        $users = User::all();
        $question = DiscussionQuestion::all();
        return view("teacher.discussion.view", compact("users", "question"));
    }
}
