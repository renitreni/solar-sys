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

    public $passwordConfirmation;

    public function render()
    {
        return view('livewire.user-livewire');
    }

    #[\Livewire\Attributes\On('edit-user')]
    public function edit($rowId)
    {
        $this->password = '';
        $this->passwordConfirmation = '';

        $user = User::find($rowId)->first();

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'max:50', 'unique:users,email,'.$this->userId.',id'],
        ]);

        $user = User::find($this->userId);

        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        $this->dispatch('pg:eventRefresh-UserTable');
        $this->js('$("#userFormModal").modal("hide")');
    }

    public function deleteUser()
    {
        User::find($this->userId)->delete();

        $this->dispatch('pg:eventRefresh-UserTable');
        $this->js('$("#userDeleteModal").modal("hide")');
    }

    public function changePassword()
    {
        $this->validate([
            'userId' => 'required',
            'password' => ['required', 'string', 'min:3', 'same:passwordConfirmation'],
            'passwordConfirmation' => 'required',
        ]);

        $user = User::find($this->userId);
        $user->password = $this->password;
        $user->save();

        $this->dispatch('pg:eventRefresh-UserTable');
        $this->js('$("#userChangePassModal").modal("hide")');
    }

    public function addNew()
    {
        $this->js('$("#userFormModal").modal("show")');
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->passwordConfirmation = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|max:50',
            'email' => ['required', 'email', 'max:50', 'unique:users,email'],
            'password' => ['required', 'string', 'min:3', 'same:passwordConfirmation'],
            'passwordConfirmation' => 'required',
        ]);

        $user = new User();
        $user->password = $this->password;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();

        $this->dispatch('pg:eventRefresh-UserTable');
        $this->js('$("#userFormModal").modal("hide")');
    }
}
