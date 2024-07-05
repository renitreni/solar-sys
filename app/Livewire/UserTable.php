<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class UserTable extends PowerGridComponent
{
    public string $tableName = 'UserTable';

    use WithExport;

    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return User::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('$("#userFormModal").modal("show")');
        $this->dispatch('edit-user', ['rowId' => $rowId]);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $this->js('$("#userDeleteModal").modal("show")');
        $this->dispatch('edit-user', ['rowId' => $rowId]);
    }

    #[\Livewire\Attributes\On('change-pass')]
    public function changePass($rowId): void
    {
        $this->js('$("#userChangePassModal").modal("show")');
        $this->dispatch('edit-user', ['rowId' => $rowId]);
    }

    public function actions(User $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="fas fa-edit"></i>')
                ->id()
                ->class('btn btn-primary btn-sm my-1')
                ->dispatch('edit', ['rowId' => $row->id]),
            Button::add('changepass')
                ->slot('<i class="fas fa-key"></i>')
                ->id()
                ->class('btn btn-warning btn-sm my-1')
                ->dispatch('change-pass', ['rowId' => $row->id]),
            Button::add('delete')
                ->slot('<i class="fas fa-trash-alt"></i>')
                ->id()
                ->class('btn btn-danger btn-sm my-1')
                ->dispatch('delete', ['rowId' => $row->id]),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
