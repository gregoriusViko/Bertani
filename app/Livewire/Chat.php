<?php

namespace App\Livewire;

use App\Models\Buyer;
use App\Events\Typing;
use App\Models\Farmer;
use Livewire\Component;
use App\Models\BuyerChat;
use App\Models\FarmerChat;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Echo;
use Illuminate\Support\Facades\Broadcast;

class Chat extends Component
{
    public $user, $role, $chats, $content, $contacts, $interlocutor, $message;
    public function getListeners()
    {
        return [
            "echo:chat.{$this->role}.{$this->user->id},MessageSent" => "updateMessage"
        ];
    }

    public function updateMessage()
    {
        if($this->user->id == Auth::guard($this->role)->user()->id){
            if($this->role == 'farmer'){
                $newChat = $this->user->farmerChats()->latest()->first();
                $interlocutor = $newChat->buyer;
            }else{
                $newChat = $this->user->buyerChats()->latest()->first();
                $interlocutor = $newChat->farmer;
            }
    
            if($this->interlocutor->id == $interlocutor->id){
                $this->content->push($newChat);
            }
            $this->chats->push($newChat);
        }
    }

    public function mount($slug = null)
    {
        $this->role = Auth::guard('farmer')->check() ? 'farmer' : 'buyer';
        $this->user = Auth::guard($this->role)->user();
        if ($this->role == 'farmer') {
            $this->chats = $this->user->farmerChats;
            $this->contacts = $this->chats->unique('buyer_id')->pluck('buyer');
            $buyer = $slug ? Buyer::where('slug', $slug)->first() : null;
            if ($buyer) {
                $this->interlocutor = $buyer;
                $this->content = $this->chats->where('buyer_id', $buyer->id);
            } elseif ($slug) {
                abort(404);
            }
        } else {
            $this->chats = $this->user->buyerChats;
            $this->contacts = $this->chats->unique('farmer_id')->pluck('farmer');
            $farmer = $slug ? Farmer::where('slug', $slug)->first() : null;
            if ($farmer) {
                $this->interlocutor = $farmer;
                $this->content = $this->chats->where('buyer_id', $farmer->id);
            } elseif ($slug) {
                abort(404);
            }
        }
    }
    public function render()
    {
        return view('livewire.chat')->layout('components.layout');
    }

    public function getTyping()
    {
        dd('dfds');
    }

    public function kirimPesan()
    {
        if ($this->role == 'farmer') {
            $farmer_id = $this->user->id;
            $buyer_id = $this->interlocutor->id;
        } else {
            $buyer_id = $this->user->id;
            $farmer_id = $this->interlocutor->id;
        }
        $message = [
            'is_read' => 0,
            'content' => $this->message,
            'farmer_id' => $farmer_id,
            'buyer_id' => $buyer_id
        ];
        FarmerChat::create($message + ['role' => $this->role == 'farmer' ? 'sender' : 'receiver']);
        BuyerChat::create($message + ['role' => $this->role == 'buyer' ? 'sender' : 'receiver']);

        $this->message = '';

        broadcast(new MessageSent($this->role == 'farmer' ? 'buyer' : 'farmer', $this->interlocutor->id))->toOthers();
        $this->updateMessage();
    }
}
