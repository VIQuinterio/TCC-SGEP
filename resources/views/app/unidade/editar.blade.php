<div id="edit-modal{{$unid->id_unidade}}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Editar Unidade
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-modal{{$unid->id_unidade}}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Editar Unidade</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="{{ route('app.unidade.atualizar') }}" method="POST">
                    @csrf
                    <div>
                        <input type="hidden" name="id" value="{{$unid->id_unidade}}">
                        <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                        <input type="text" name="nome" id="nome" value="{{$unid->nm_unidade}}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                    </div>
                    <div>
                        <label for="endereco"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Endereço</label>
                        <input type="text" name="endereco" id="endereco" value="{{$unid->ds_endereco}}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                    </div>
                    <div>
                        <label for="contato"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefone</label>
                        <input type="tel" name="contato" id="contato" value="{{$unid->ds_contato}}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                    </div>
                    <div>
                        <p>Selecione as modalidades e insira o horário de aula para cada uma:</p>
                        @foreach ($list_modalidades as $modalidade)
                            <div class="flex items-center me-4">
                                <input id="modalidade_{{ $modalidade->id_modalidade }}" type="checkbox" name="modalidades[]" value="{{ $modalidade->id_modalidade }}" 
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 
                                dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 checkbox-trigger">
                                <label for="modalidade_{{ $modalidade->id_modalidade }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $modalidade->nm_modalidade }}</label>
                                <!-- Campo de entrada para o horário de aula (inicialmente oculto) -->
                                <input type="text" name="horario_{{ $modalidade->id_modalidade }}" placeholder="Horário de aula" 
                                class="w-32 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 
                                dark:placeholder-gray-400 dark:text-white hidden hora-input">
                            </div>
                        @endforeach
                    </div>
                    <!-- Rodapé do Modal -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Atualizar</button>
                        <button data-modal-hide="edit-modal{{$unid->id_unidade}}" type="button"
                            class="ml-5 ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Obtenha o modal específico
    var modal{{$unid->id_unidade}} = document.getElementById('edit-modal{{$unid->id_unidade}}');

    // Quando o usuário clicar fora do modal, não feche
    modal{{$unid->id_unidade}}.addEventListener('click', function(event) {
        if (event.target === modal{{$unid->id_unidade}}) {
            event.stopPropagation(); // Impede a propagação do evento de fechamento do modal
        }
    });

    document.addEventListener('click', function(event) {
        var checkboxes = document.querySelectorAll('.checkbox-trigger');
        checkboxes.forEach(function(checkbox) {
            if (event.target.id === checkbox.id || event.target.htmlFor === checkbox.id) {
                var horarioInput = checkbox.nextElementSibling.nextElementSibling;
                if (checkbox.checked) {
                    horarioInput.classList.remove('hidden');
                } else {
                    horarioInput.classList.add('hidden');
                }
            }
        });
    });
</script>