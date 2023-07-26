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
                                <a class="px-4 py-2 text-sm font-medium text-white bg-blue-500 border border-blue-200 rounded-l-lg hover:bg-blue-600" href="javascript:void(0)" wire:click.prevent='showModal()'>+&nbsp;Feature</a>
                                <a class="px-4 py-2 text-sm font-medium text-white bg-red-500 border border-red-200 rounded-r-md hover:bg-red-600" href="javascript:void(0)" wire:click.prevent='remove({{$plan->id}})'>Remover</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
    
    {{$plans->withQueryString()->links()}}

    @if($showModal)
    <div class="modal">
        <div class="{{!$showModal ? 'hidden' : ''}} fixed z-10 inset-0 overflow-y-auto ease-out duration-300">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <!-- extrair para componente plan > feature > create -->
                    
                    <div>
                      <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                          <div class="sm:flex sm:items-start">
                              <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-green-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                  <!-- Heroicon name: outline/exclamation -->
                                  <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                      <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
                                      <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                                  </svg>
                              </div>
                              <div class="w-full mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                  <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                                      Cadastrar Nova Feature
                                  </h3>
                                  <form action="">
                                      <div class="mt-2">
                                          <label>Feature</label>
                                          <input wire:model="feature.name" type="text" placeholder="Nome da Feature" class="placeholder-black block appearance-none w-full bg-gray-200 border @error('feature.name') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                          @error('feature.name')
                                          <div class="w-full font-bold text-red-600">{{$message}}</div>
                                          @enderror
                                      </div>

                                      <div class="mt-2">
                                          <label>Tipo</label>
                                          <select wire:model="feature.type" class="block appearance-none w-full bg-gray-200 border @error('feature.type') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                              <option value="">Selecione o Tipo da Feature</option>
                                              <option value="amount">Quantidade de Registros</option>
                                              <option value="view">Área de Tela</option>
                                          </select>

                                          @error('feature.type')
                                          <div class="w-full font-bold text-red-600">{{$message}}</div>
                                          @enderror
                                      </div>

                                      <div class="mt-2">
                                          <label>Regra da Feature</label>
                                          <textarea wire:model="feature.feature_rule" placeholder="Regra da Feature"  class="placeholder-black block appearance-none w-full bg-gray-200 border @error('feature.feature_rule') border-red-500 @else border-gray-200 @enderror  text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"></textarea>

                                          @error('feature.feature_rule')
                                          <div class="w-full font-bold text-red-600">{{$message}}</div>
                                          @enderror
                                      </div>

                                  </form>
                              </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button wire:click.prevent="addFeature" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Cadastrar
                            </button>
                            <button wire:click.prevent="closeModal" type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </div>

                    <!-- end extracao -->
                </div>
            </div>
        </div>
        <!-- Modal -->
    @endif
</div>