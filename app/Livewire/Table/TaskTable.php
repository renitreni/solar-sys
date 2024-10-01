<?php

namespace App\Livewire\Table;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class TaskTable extends PowerGridComponent
{
    use WithExport;

    public string $sortField = 'service_name'; 

    public string $sortDirection = 'asc';

    public string $tableName = 'TaskTable';

    public string $projectId;

    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Task::query()->selectRaw('tasks.*')
            ->leftJoin('services as service', 'service.id', '=', 'tasks.service_id')
            ->where('project_id', $this->projectId)
            ->with('service');
    }

    public function relationSearch(): array
    {
        return [
            'service' => [
                'service_name',
                'price',
            ],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('price')
            ->add('service.service_name')
            ->add('service.price')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')->hidden(),
            Column::make('Service Name', 'service.service_name')
                ->sortable(),
            Column::make('Task Price', 'price')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(Task $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->id()
                ->class('btn btn-xs btn-primary')
                ->dispatch('edit-task', [$row]),
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
