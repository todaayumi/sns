<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Tweet; 

class TimelineController extends Controller
{
    public function showTimelinePage(){

        $tweets = Tweet::latest()->get();
        return  view('auth.timeline', compact('tweets'));
    }

    public function postTweet(Request $request){

        $validator = $request->validate([
            'tweet' => ['required', 'max:140', 'string'],
        ]);

        Tweet::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'tweet' => $request->tweet,
            ]);

            return back();
    }
}
