<?php

namespace App\Http\Controllers;

use App\Models\Polls;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PollVotingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::paginate(6)->through(function ($item) {
            return [
                'id' => $item->id,
                'question_description' => Str::limit($item->question_description, 60),
                'votes' => $item->votes,
                'choices' => $item->choices,
                'poll_tittle' => $item->poll->poll_tittle,
                'choice' => $item->choice
                // etc
            ];
        });

        return Inertia::render('Polls/PollVoting', [
            'questions' => $questions,
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Polls $polls)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Polls $polls)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Polls $polls)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Polls $polls)
    {
        //
    }
}
