<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;

use function Laravel\Prompts\select;

class ToolCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tool';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tools for gestion tasks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $role = select(
            label: 'Qué tarea quieres escoger?',
            options: Task::all()->pluck('name', 'id'),
            scroll: 10
        );
    }
}
