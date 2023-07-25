<div class='py-6 mx-auto max-w-7xl sm:px-6 lg:px-8'>
    <x-slot name="header">
        <h3>Meus registros</h3>
    </x-slot>

    <div class="w-full mx-auto mb-4 text-right">
        <a href="{{route('plans.create')}}" class="flex-shrink-0 px-2 py-1 text-sm text-white bg-teal-500 border-4 border-teal-500 rounded hover:bg-teal-700 hover:border-teal-700">Criar Registro</a>
    </div>

    @include('includes.message')

    <div class="relative pb-3 overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Descrição
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Referência
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Valor
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Criado em
                    </th>
                    <th scope="col" class="w-0 px-6 py-3 text-right">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$plan->description}}
                        </th>
                        <td class="px-6 py-4">
                            {{$plan->reference}}
                        </td>
                        <td class="w-0 px-6 py-4">
                            {{number_format($plan->price, 2, ',', '.')}}
                        </td>
                        <td class="px-6 py-4">
                            {{$plan->created_at->format('d/m/Y H:i')}}
                        </td>
                        <td class='px-6 py-4'>
                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                <a class="px-4 py-2 text-sm font-medium text-white bg-red-500 border border-red-200 rounded-md hover:bg-red-600" href="javascript:void(0)" wire:click.prevent='remove({{$plan->id}})'>Remover</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    
    {{$plans->withQueryString()->links()}}

</div>