<div id="edit-modal{{$event->id_evento}}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Editar Evento
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-modal{{$event->id_evento}}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Editar Evento</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="{{ route('app.evento.atualizar') }}" method="POST">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <input type="hidden" name="id" value="{{$event->id_evento}}">
                            <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                            <input type="text" name="nome" id="nome" value="{{$event->nm_evento}}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>
                        <div class="col-span-2">
                            <label for="descricao"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                            <input type="text" name="descricao" id="descricao" value="{{$event->ds_evento}}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="dataInicio"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data Início do Evento</label>
                            <input type="date" name="dataInicio" id="dataInicio" value="{{$event->dt_evento_inicio}}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="dataFim"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data Fim do Evento</label>
                            <input type="date" name="dataFim" id="dataFim" value="{{$event->dt_evento_fim}}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                        </div>
                        <div class="col-span-2">
                            <label for="unidade"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unidade</label>
                                <select id="unidade" name="id_unidade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    @foreach ($list_unidades as $unidade)
                                        <option value="{{ $unidade->id_unidade }}">{{ $unidade->nm_unidade }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <!-- Rodapé do Modal -->
                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Atualizar</button>
                            <button data-modal-hide="edit-modal{{$event->id_evento}}" type="button"
                                class="ml-5 ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<script>
    // Obtenha o modal específico
    var modal{{$event->id_evento}} = document.getElementById('edit-modal{{$event->id_evento}}');

    // Quando o usuário clicar fora do modal, não feche
    modal{{$event->id_evento}}.addEventListener('click', function(event) {
        if (event.target === modal{{$event->id_evento}}) {
            event.stopPropagation(); // Impede a propagação do evento de fechamento do modal
        }
    });
</script>