<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserLivewire extends Component
{
    public $userId;

    public $name;

    public $email;

    public $password;

    public function render()
    {
        return view('livewire.user-livewire');
    }

    #[\Livewire\Attributes\On('edit-user')]
    public function edit($rowId)
    {
        $user = User::find($rowId)->first();

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::find($this->userId);

        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        $this->dispatch('pg:eventRefresh-UserTable');
        $this->js('$("#userFormModal").modal("hide")');
    }
}
