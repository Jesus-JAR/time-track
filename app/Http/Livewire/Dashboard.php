<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;


class Dashboard extends Component
{
    public function render()
    {
        $logins = User::all()
            ->where('id', '=', auth()->id());
        return view('livewire.dashboard', compact('logins'));
    }
}
