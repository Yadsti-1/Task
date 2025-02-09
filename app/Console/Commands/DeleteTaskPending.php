<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Task;
use function Laravel\Prompts\form;
use function Laravel\Prompts\table;

class DeleteTaskPending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deletetask';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina todas las tareas que están en soft delete y que no han sido eliminadas permanentemente';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Borrar tareas que el delete_at sea mayor a 5 días
        Task::where('deleted_at', '!=', null)
        ->where('deleted_at', '<=', now()->subDays(5))
        ->forceDelete();
    }
}
