<?php

namespace App\Http\Controllers;

use App\Http\Resources\PollsResource;
use App\Models\Polls;
use App\Models\Question;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

use Illuminate\Support\Str;


class PollController extends Controller
{

       /**
       * Display a listing of the resource.
       */
       public function home(): Response
       {
            // dd(request()->input('poll-id'));
            // query for

            $polls = Polls::paginate(6)->through(function ($item) {
                return new PollsResource($item) ;
            });

            //    dd($polls);
            return Inertia::render('PollingHome', [
                'poll-id' => request()->input('poll-id') ?? null,
                'polls' => $polls,
                'system_polls' => Polls::all()->count(),
                'poll_participation' => User::all()->count()
            ]);
       }



    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        // dd(request()->input('poll-id'));
        // query for

         $questions = Question::paginate(6)->through(function ($item) {
            return [
                'id' => $item->id,
                'question_description' => Str::limit($item->question_description, 60),
                'votes' => $item->votes,
                'choices' => $item->choices,
                'poll_tittle' => $item->poll->poll_tittle,
                // etc
            ];
         });

        return Inertia::render('Polls/PollsIndex', [
            'poll-id' => request()->input('poll-id') ?? null,
            'questions' => $questions,
            'poll' => Polls::find(request()->input('poll-id')) ?? null,
            'days' => request()->has('poll-id') ? Carbon::parse(Polls::find(request()->input('poll-id'))->end_date)->diffForHumans() : null
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
       Polls::create([
        'poll_tittle' => request()->input('poll_tittle'),
        'votes' => request()->input('votes') ,
        'questions' => request()->input('questions') ,
        'userId' => Auth::user()->id,
        'end_date' => request()->input('end_date')
       ]);

        return to_route('polls.home');
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

    public function polls()
    {
        return   Polls::paginate(6)->through(function ($item) {
            return [
                'id' => $item->id,
                'poll_tittle' => $item->poll_tittle,
                // etc
            ];
        });
    }
}
