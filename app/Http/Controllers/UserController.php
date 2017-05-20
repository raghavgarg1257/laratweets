<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\User;
use App\Follower;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        // getting user
        $user = User::where('name', '=', $username)->first();

        // checking if user exist
        if (!$user) {
            return redirect('home');
        }

        // getting feeds
        $feed = Auth::user()->getFeed($username);

        $followed_user = Auth::user()->followed_users()->pluck('id')->toArray();
        $user->followed = !!in_array($user->id, $followed_user);

        // showing users profile page
        return view('user', compact('feed', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function toggleFollow(Request $request)
    {
        if (
            User::find($request->user_id) &&
            User::find($request->other_user_id)
        ) {

            $current_status = Follower::where([
                ['user_id', '=', $request->user_id],
                ['followed_user_id', '=', $request->other_user_id]
            ])->first();

            if ($request->status && !$current_status) {
                // make record in follower table
                $follow = new Follower([
                    'user_id' => $request->user_id,
                    'followed_user_id' => $request->other_user_id
                ]);
                $follow->save();
                return 1;
            }
            else if (!$request->status && $current_status) {
                // delete record from follower table
                Follower::where([
                    ['user_id', '=', $request->user_id],
                    ['followed_user_id', '=', $request->other_user_id]
                ])->delete();
                return 1;
            }
            else {
                // bad request
                return 0;
            }

        }
        else {
            // bad request
            return 0;
        }
    }


}
