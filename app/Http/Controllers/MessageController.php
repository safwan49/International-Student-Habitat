<?php
namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
class MessageController extends Controller {

    //List every users in dm
    public function index(){
        $partners = auth()->user()->conversationPartners();
        $unreadCounts = Message::where('receiver_id', auth()->id())
            ->unread()
            ->selectRaw('sender_id, count(*) as cnt')
            ->groupBy('sender_id')
            ->pluck('cnt', 'sender_id');
        return view('messages.index', compact('partners', 'unreadCounts'));
        }

        //If user opens dm, all messages of that dm will be shown as read to the other person
    public function show(User $user){
        Message::where('sender_id', $user->id)
            ->where('receiver_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
        $messages = Message::thread(auth()->id(), $user->id);
        return view('messages.show', compact('messages', 'user'));
    }

    //Send message to an user
    public function store(Request $request, User $user) {
        $request->validate(['body' => 'required|string|max:2000']);
        //self message not possible
        abort_if($user->id === auth()->id(), 403, 'Cannot message yourself.');
        Message::create(['sender_id'=> auth()->id(),'receiver_id' => $user->id,'body'=> $request->body]);
        return back()->with('success', 'Message sent.');
    }
}
