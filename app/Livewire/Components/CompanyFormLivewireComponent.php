<?php

namespace App\Livewire\Components;

use App\Models\Company;
use Livewire\Attributes\On;
use Livewire\Component;

class CompanyFormLivewireComponent extends Component
{
    public $companyName;

    public $companyId;

    #[On('company-edit')]
    public function bindEdit($companyId)
    {
        $client = Company::find($companyId);
        $this->companyName = $client->company_name;
        $this->companyId = $client->id;
    }

    #[On('client-add')]
    public function clearFields()
    {
        $this->companyName = null;
        $this->companyId = null;
        $this->js('$("#companyFormModal").modal("show")');
    }

    public function updated($property, $value)
    {
        $this->$property = trim($value);
    }

    public function store()
    {
        $this->validate([
            'companyName' => ['required', 'unique:clients,company_name'],
        ]);

        $client = new Company;
        $client->company_name = $this->companyName;
        $client->save();

        $this->js('$("#companyFormModal").modal("hide")');
        $this->dispatch('pg:eventRefresh-CompanyTable');
    }

    public function update()
    {
        $this->validate([
            'companyName' => ['required', 'unique:companies,company_name,'.$this->companyId],
        ]);

        $client = Company::find($this->companyId);
        $client->company_name = $this->companyName;
        $client->save();

        $this->js('$("#companyFormModal").modal("hide")');
        $this->dispatch('pg:eventRefresh-CompanyTable');
    }

    public function destroy()
    {
        Company::find($this->companyId)->delete();

        $this->js('$("#companyFormModal").modal("hide")');
        $this->dispatch('pg:eventRefresh-CompanyTable');
    }

    public function render()
    {
        return view('livewire.components.company-form-livewire-component');
    }
}
