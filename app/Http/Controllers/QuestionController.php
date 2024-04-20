<?php

namespace App\Http\Controllers;

use App\Models\Choices;
use App\Models\Question;
use Illuminate\Console\View\Components\Choice;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : Response
    {

        // dd(request());
       return Inertia::render('Polls/QuestionsIndex',[
        'question_id' => request()->input('question_id') ?? null,
        'choices' => Question::find(request()->input('question_id')['id'])->choice()->get()
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
        // dd(request()->all());

        try{
            $_question = Question::create([
            'question_description' => request()->input('question_description'),
            'votes' => request()->input('votes') ?? 30,
            'choices' => count(request()->input('choices')),
            'pollId' => request()->input('pollId'),
            ])->choice()->createMany(array_map(function ($choice) {
              return ['choice_desc' => $choice, 'votes' => 4];
            }, request()->input('choices')));



        }catch(\Exception $e){
           // To:do Handdle Exceptio
        }




    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
