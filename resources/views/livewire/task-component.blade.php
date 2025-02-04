<section class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg ">
    <div class="container">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4">
                <div class="max-w-full overflow-x-auto">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-5" wire:click="openCreateModal">
                        Nuevo
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
                                        <a href="javascript:void(0)" class="
                                                        border border-primary
                                                        py-2
                                                        px-6
                                                        text-primary
                                                        inline-block
                                                        rounded
                                                        hover:bg-primary hover:text-blue
                                                        ">
                                            <button
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" wire:click="openCreateModal({{ $task->id }})">Editar</button>
                                            <button
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" wire:click="deleteTask({{ $task }})" wire:confirm="Are you sure you want to delete this task?" >Eliminar</button>
                                        </a>
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

<!-- ====== Modal End -->
</section>
<!-- ====== Table Section End -->      
