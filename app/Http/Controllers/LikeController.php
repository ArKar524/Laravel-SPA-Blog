<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function like(Request $request)
    {
        $isExit = Like::where('post_id', $request->post_id)->where('user_id', Auth::user()->id)->first();

        // dd($isExit);
        $request->validate([
            'post_id' => 'required',
            'like' => 'required',
        ]);
        if ($isExit) {
            return back();
        } else {
            Like::create([
                'user_id' => Auth::user()->id,
                'post_id' => $request->post_id,
                'like' => $request->like,
            ]);
            // dd('yes');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function unlike(Request $request)
    {

        // dd($request->all());
        Like::where('user_id', Auth::user()->id)->where('post_id', $request->post_id)->delete();
        return back();
    }
}