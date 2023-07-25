<div class='py-6 mx-auto max-w-7xl sm:px-6 lg:px-8'>
    <x-slot name="header">
        <h3>Criar registro</h3>
    </x-slot>

    @include('includes.message')

    <form action="" wire:submit.prevent='save'>
        <div class='mb-2'>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
            <input wire:model="description" type="text" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('description')
                <h3 class="mt-1 text-red-600 dark:text-red-400">{{$message}}</h3>
            @enderror
        </div>

        <div class='mb-2'>
            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor</label>
            <input wire:model="amount" type="text" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('amount')
                <h3 class="mt-1 text-red-600 dark:text-red-400">{{$message}}</h3>
            @enderror
        </div>

        <div class='mb-2'>
            <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo</label>
            <select wire:model="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1">Entrada</option>
                <option value="2">Saída</option>
            </select>
            @error('type')
                <h3 class="mt-1 text-red-600 dark:text-red-400">{{$message}}</h3>
            @enderror
        </div>

        <button type="submit" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Alterar registro</button>

    </form>
</div>
