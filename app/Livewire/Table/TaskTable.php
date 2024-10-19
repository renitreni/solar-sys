<?php

namespace App\Livewire\Table;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Detail;
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
            Detail::make()
                ->view('components.row-details')
                ->showCollapseIcon()
                ->params(['name' => 'Luan']),
        ];
    }

    public function datasource(): Builder
    {
        return Task::query()->selectRaw('tasks.*')
            ->leftJoin('services as service', 'service.id', '=', 'tasks.service_id')
            ->where('project_id', $this->projectId)
            ->with('service', 'assignees');
    }

    public function relationSearch(): array
    {
        return [
            'service' => [
                'service_name',
                'price',
            ],
            'assignees' => [
                'assignee_name',
            ],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('price')
            ->add('service.service_name')
            ->add('assignees_summary', function ($task) {
                $assignee = '';
                foreach ($task->assignees as $data) {
                    $assignee .= "<span class=\"badge bg-primary\">$data->assignee_name</span>";
                }

                return $assignee;
            })
           // ->add('other_description')
            ->add('service.price')
            ->add('created_at')
            // ->add('notes_view', function ($task) {
            //     return Blade::render($task->notes);
            // })
            ->add('is_new_task', function ($task) {
                $event = 'is-new-task-switch-event';
                $keyed_id = 'task_id';
                $keyed = 'is_new_task';
                $model = $task->toArray();

                return view('components.switch-toggle-component', compact('model', 'event', 'keyed', 'keyed_id'));
            })
            ->add('is_new_task_override', function ($task) {
                $event = 'is-task-price-override-switch-event';
                $keyed_id = 'task_id';
                $keyed = 'is_new_task_override';
                $model = $task->toArray();

                return view('components.switch-toggle-component', compact('model', 'event', 'keyed', 'keyed_id'));
            });
    }

    #[On('is-new-task-switch-event')]
    public function isNewTaskSwitchEvent($value)
    {
        $task = Task::find($value['task_id']);
        $task->is_new_task = $value['is_new_task'] ? 0 : 1;
        $task->save();
    }

    #[On('is-task-price-override-switch-event')]
    public function isTaskPriceOverrideEvent($value)
    {
        $task = Task::find($value['task_id']);
        $task->is_new_task_override = $value['is_new_task_override'] ? 0 : 1;
        $task->save();
    }

    public function columns(): array
    {
        return [
            Column::action('Action'),
            Column::make('Id', 'id')->hidden(),
            Column::make('Service Name', 'service.service_name')->sortable()->searchable(),
            Column::make('Assigned To', 'assignees_summary'),
            // Column::make('Other Service Description', 'other_description'),
            Column::make('Is New Task', 'is_new_task'),
            Column::make('Is New Task Override', 'is_new_task_override'),
            Column::make('Task Price', 'price')->sortable()->searchable(),
            Column::make('Created at', 'created_at')->sortable()->searchable(),
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
