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
    public $user, $role, $chats, $content, $contacts, $friend, $message;
    public function getListeners()
    {
        return [
            "echo-private:chat.{$this->role}.{$this->user->slug},MessageSent" => "updateMessage"
        ];
    }

    public function updateMessage($responce)
    {
            if($this->role == 'farmer'){
                $newChat = FarmerChat::find($responce['message']);
                $user = $newChat->farmer;
            }else{
                $newChat = BuyerChat::find($responce['message']);
                $user = $newChat->buyer;
            }
    
            if($this->user->id === $user->id){
                $this->chats->push($newChat);
            }
            if($this->friend && $this->friend->slug == $responce['sender']){
                $this->content->push($newChat);
                $this->readed();
            }
            $this->updateContact();
    }

    public function updateContact(){
        if($this->role == 'farmer'){
            $this->contacts = $this->chats->sortByDesc('send_time')->groupBy('buyer_id')->map(function($contact){
                return [
                    'name' => $contact->first()->buyer->name,
                    'slug' => $contact->first()->buyer->slug,
                    'profile_img_link' => $contact->first()->buyer->profile_img_link,
                    'not_read' => $contact->sum(function($pesan){
                        return $pesan->role == 'receiver' && $pesan->is_read == 0 ? 1 : 0;
                    })
                ];
            });
        }else{
            $this->contacts = $this->chats->sortByDesc('send_time')->groupBy('farmer_id')->map(function($contact){
                return [
                    'name' => $contact->first()->farmer->name,
                    'slug' => $contact->first()->farmer->slug,
                    'profile_img_link' => $contact->first()->farmer->profile_img_link,
                    'not_read' => $contact->sum(function($pesan){
                        return $pesan->role == 'receiver' && $pesan->is_read == 0 ? 1 : 0;
                    })
                ];
            });
        }
    }

    public function mount($slug = null)
    {
        $this->role = Auth::guard('farmer')->check() ? 'farmer' : 'buyer';
        $this->user = Auth::guard($this->role)->user();
        if ($this->role == 'farmer') {
            $this->chats = $this->user->farmerChats()->get();
            $buyer = $slug ? Buyer::where('slug', $slug)->first() : null;
            if ($buyer) {
                $this->friend = $buyer;
                $this->content = $this->chats->where('buyer_id', $buyer->id);
            } elseif ($slug) {
                abort(404);
            }
        } else {
            $this->chats = $this->user->buyerChats;
            $farmer = $slug ? Farmer::where('slug', $slug)->first() : null;
            if ($farmer) {
                $this->friend = $farmer;
                $this->content = $this->chats->where('farmer_id', $farmer->id);
            } elseif ($slug) {
                abort(404);
            }
        }
        $this->readed();
        $this->updateContact();
    }

    public function readed(){
        if($this->content){
            foreach($this->content as $message){
                $message->is_read = 1;
                $message->save();
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
            $buyer_id = $this->friend->id;
        } else {
            $buyer_id = $this->user->id;
            $farmer_id = $this->friend->id;
        }
        $message = [
            'is_read' => 0,
            'content' => $this->message,
            'farmer_id' => $farmer_id,
            'buyer_id' => $buyer_id
        ];
        $chatFarmer = FarmerChat::create($message + ['role' => $this->role == 'farmer' ? 'sender' : 'receiver']);
        $chatBuyer = BuyerChat::create($message + ['role' => $this->role == 'buyer' ? 'sender' : 'receiver']);

        $this->message = '';

        $newChat = $this->role == 'farmer' ? $chatFarmer : $chatBuyer;

        $friendRole = $this->role == 'farmer' ? 'buyer' : 'farmer';

        broadcast(new MessageSent($this->friend->slug, $friendRole, $newChat->id, $this->role));
        $this->content->push($newChat);
    }
}
