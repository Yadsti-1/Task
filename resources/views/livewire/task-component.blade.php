<section class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" wire:poll = "renderAllTasks">
    <div class="container">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4">
                <div class="max-w-full overflow-x-auto">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-5" wire:click="openCreateModal">
                        Nuevo
                    </button>
                    <button
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded my-5" 
                        wire:click="removeAllTasks" wire:confirm="¿Estás seguro de que quieres eliminar todas las tareas?">
                        Borrar todas las tareas
                    </button>
                    <button
                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded my-5" 
                        wire:click="recoverAllTasks" wire:confirm="¿Estás seguro de que quieres restaurar todas las tareas?">
                        Restaurar todas las tareas
                    </button>
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-purple-800 text-center">
                                <th class="
                                                w-1/6
                                                min-w-[160px]
                                                text-lg
                                                font-semibold
                                                text-white
                                                py-4
                                                lg:py-7
                                                px-3
                                                lg:px-4
                                                border-l border-transparent
                                                ">
                                    Nombre
                                </th>
                                <th class="
                                                w-1/6
                                                min-w-[160px]
                                                text-lg
                                                font-semibold
                                                text-white
                                                py-4
                                                lg:py-7
                                                px-3
                                                lg:px-4
                                                ">
                                    Descripción
                                </th>
                                <th class="
                                                w-1/6
                                                min-w-[160px]
                                                text-lg
                                                font-semibold
                                                text-white
                                                py-4
                                                lg:py-7
                                                px-3
                                                lg:px-4
                                                ">
                                    Acciones
                                </th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="
                                                    text-center text-black
                                                    font-medium
                                                    text-base
                                                    py-5
                                                    px-2
                                                    bg-white
                                                    border-b border-[#E8E8E8]
                                                    ">
                                        {{ $task->name }}
                                    </td>
                                    <td class="
                                                    text-center text-black
                                                    font-medium
                                                    text-base
                                                    py-5
                                                    px-2
                                                    bg-[#F3F6FF]
                                                    border-b border-[#E8E8E8]
                                                    ">
                                        {{ $task->description }}
                                    </td>
                                    <td class="
                                                    text-center text-black
                                                    font-medium
                                                    text-base
                                                    py-5
                                                    px-2
                                                    bg-white
                                                    border-b border-r border-[#E8E8E8]
                                                    ">
                                                    @if ($task->pivot)
                                                        <button class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-2 rounded" wire:click="unshareTask({{ $task }})">
                                                            Descompartir
                                                        </button>
                                                        @endif
                                                    
                                                    @if (
                                                        auth()->user()->id === $task->user_id ||($task->pivot && $task->pivot->permission === 'write'))
                                                     <div >
                                                        <button 
                                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded" 
                                                            wire:click="openCreateModal({{ $task }})">
                                                            Editar
                                                        </button>

                                                        

                                                        <button 
                                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-2 rounded"
                                                        wire:click="openShareModal({{ $task }})">
                                                            Compartir
                                                        </button>
                                                        
                                                        <button 
                                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded" 
                                                            wire:click="deleteTask({{ $task }})" 
                                                            wire:confirm="¿Estás seguro de que quieres eliminar esta tarea?">
                                                            Eliminar
                                                        </button>
                                                     </div>
                                                    @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
     <!-- ====== Modal -->
    @if ($modal)
        <div class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
            <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
                <div class="w-full">
                    <div class="m-8 my-20 max-w-[400px] mx-auto">
                        <div class="mb-8">
                            <h1 class="mb-4 text-3xl text-black font-extrabold">{{ isset($miTarea->id) ? 'Actualizar' : 'Crear' }}   tarea</h1>
                            <form>
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <input wire:model="name" type="text" name="name" id="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-black sm:text-sm border-gray-800 rounded-md" placeholder="Nombre de la tarea"></input>
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                                    <input wire:model="description" name="description" id="description" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm text-black sm:text-sm border-gray-800 rounded-md" placeholder="Descripción de la tarea"></input>
                                </div>
                            </form>
                        </div>
                        <div class="flex flex-row">
                            <button class="p-3 bg-black rounded-full text-white w-full font-semibold" wire:click.prevent="createorUpdateTask">
                            {{ isset($miTarea->id) ? 'Actualizar' : 'Crear' }} tarea
                            </button>
                            <button class="p-3 bg-white border rounded-full w-full text-black font-semibold" wire:click.prevent="closeCreateModal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ====== Modal compartir -->

    @if ($modalShare)
        <div class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10">
                <div class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white">
                    <div class="w-full">
                        <div class="m-8 my-20 max-w-[400px] mx-auto">
                            <div class="mb-8">
                                <h1 class="mb-4 text-3xl text-black font-extrabold">Compartir tarea</h1>
                                <form>
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Usuario a compartir</label>
                                        <select wire:model="user_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="">Seleccione un usuario</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="description" class="block text-sm font-medium text-gray-700">Permisos</label>
                                        <select wire:model="permission"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="">Seleccione un permiso</option>
                                            <option value="view">Ver</option>
                                            <option value="write">Editar</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="flex flex-row">
                                <button class="p-3 bg-black rounded-full text-white w-full font-semibold" wire:click.prevent="shareTask">
                                Compartir tarea
                                </button>
                                <button class="p-3 bg-white border rounded-full w-full text-black font-semibold" wire:click.prevent="closeShareModal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif
    
<!-- ====== Modal End -->
</section>
<!-- ====== Table Section End -->
