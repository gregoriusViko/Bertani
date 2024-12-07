<?php

namespace App\Livewire;

use App\Events\Typing;
use Livewire\Component;

class Counter extends Component
{

    public $count = 0;
    public $coba = '';

    public function getListeners(){
        return [
            'echo:coba-ketik.1,Typing' => 'getTyping'
        ];
    }
 
    public function increment()
    {
        $this->count++;
        $coba = broadcast(new Typing(1))->toOthers();
        dd($coba);
    }

    public function getTyping(){
        $this->coba = 'berhasil';
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
