<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

        $user_id = auth()->user()->id;
        $messages = DB::table('messages')->where('sender_id', '=', $user_id)->orWhere('receiver_id', '=', $user_id)->get();
        return response()->json($messages);
    }
    public function getUserMessages()
    {
        $receiverDetails = User::with('senderMessage', 'receiverMessage')->get();

        $sender_ids = DB::table('messages')->select('sender_id')->distinct()->get();

        $userMessages = User::with('senderMessage', 'receiverMessage')->where('role', '=', 0)->get();
        return response()->json([
            'userMessages' => $userMessages,
            'sender_ids' => $sender_ids,
        ]);
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
        $receiver_id = DB::table('users')->select('id')->where('role', '=', 1)->value('id');
        $message = new Message([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $receiver_id,
            'message' => $request->input('message')
        ]);
        $message->save();
        return response()->json('Message sent successfully');
    }
    public  function sendMessage(Request $request)
    {

        $adminMessage = new Message([
            'sender_id' => auth()->user()->id,
            'receiver_id' => 1,
            'message' => $request->input('message')
        ]);
        $adminMessage->save();
        return response()->json('Message sent successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
