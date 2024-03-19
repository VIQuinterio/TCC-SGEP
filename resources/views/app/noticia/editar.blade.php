<div id="edit-modal{{$news->id_noticia}}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Editar Notícia
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-modal{{$news->id_noticia}}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Editar Notícia</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="space-y-4" action="{{ route('app.noticia.atualizar') }}" method="POST" id="form_edicao" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2 sm:col-span-1">                            
                            <input type="hidden" name="id" value="{{$news->id_noticia}}">
                            <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título</label>
                            <input type="text" name="nome" id="nome" value="{{$news->nm_titulo}}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="data"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data</label>
                            <input type="date" name="data" id="data" value="{{$news->dt_noticia}}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required>
                        </div>
                        <div class="col-span-2">                                        
                            <label for="imagem"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Capa</label>
                            <input type="file" name="imagem" id="imagem" value="{{$news->im_capa}}"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 
                            dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="imagem" required>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="img">Formatos suportados: SVG, PNG, JPG ou JPEG</p>
                        </div>
                        <div class="col-span-2" style="margin-bottom: auto;">               
                            <div id="toolbar-edit" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 
                                dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" style="border-bottom-right-radius: 0; border-bottom-left-radius: 0;">
                                <span class="ql-formats">
                                    <select class="ql-font">
                                        <option class="ql-font-arial" value="arial" selected>Arial</option>
                                        <option class="ql-font-helvetica" value="helvetica">Helvetica</option>
                                        <option class="ql-font-impact" value="impact">Impact</option>
                                        <option value="monospace">Monospace</option>
                                        <option class="ql-font-roboto-mono"  value="roboto-mono">Roboto Mono</option>
                                        <option value="sans-serif">Sans Serif</option>
                                        <option value="serif">Serif</option>
                                        <option class="ql-font-verdana" value="verdana">Verdana</option>
                                    </select>
                                    <select class="ql-size" style="width: 76px">
                                        <option value="small">Pequeno</option>
                                        <option selected></option>
                                        <option value="large">Grande</option>
                                        <option value="huge">Enorme</option>
                                    </select>
                                    <select class="ql-header" style="width: 76px">
                                        <option value="1">Título 1</option>
                                        <option value="2">Título 2</option>
                                        <option value="3">Título 3</option>
                                        <option value="4">Título 4</option>
                                        <option value="5">Título 5</option>
                                        <option value="6">Título 6</option>
                                        <option selected></option>
                                    </select>
                                </span>
                            
                                <span class="ql-formats">
                                    <button class="ql-bold"></button>
                                    <button class="ql-italic"></button>
                                    <button class="ql-underline"></button>
                                    <button class="ql-strike"></button>
                                    <button class="ql-blockquote"></button>                                                      
                                    <select class="ql-color"></select>
                                    <select class="ql-background"></select>
                                    <button class="ql-clean"></button> 
                                </span>
    
                                <span class="ql-formats">
                                    <button class="ql-list" value="ordered"></button>
                                    <button class="ql-list" value="bullet"></button>
                                    <button class="ql-indent" value="-1"></button>
                                    <button class="ql-indent" value="+1"></button>
                                    <button class="ql-direction" value="rtl"></button>
                                    <button class="ql-align" value=""></button>
                                    <button class="ql-align" value="center"></button>
                                    <button class="ql-align" value="right"></button>
                                    <button class="ql-align" value="justify"></button>
                                </span>                                                                                                               
    
                                <span class="ql-formats">  
                                    <button class="ql-link"></button>
                                    <button class="ql-image"></button>
                                    <button class="ql-video"></button>
                                </span>
                            </div>                         
                            <div id="editor-container" class="block w-full px-0 text-sm text-gray-800 px-4 py-2 bg-white rounded-b-lg 
                            border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"></div>

                            <textarea th:field="*{content}" class="form-control" name="conteudo" style="display:none" id="hiddenTextarea1" value="{{$news->ds_conteudo}}"></textarea>                                                                      
                        </div>
                        <!-- Rodapé do Modal -->
                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Atualizar</button>
                            <button data-modal-hide="edit-modal{{$news->id_noticia}}" type="button"
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
    var modal{{$news->id_noticia}} = document.getElementById('edit-modal{{$news->id_noticia}}');

    // Quando o usuário clicar fora do modal, não feche
    modal{{$news->id_noticia}}.addEventListener('click', function(event) {
        if (event.target === modal{{$news->id_noticia}}) {
            event.stopPropagation(); // Impede a propagação do evento de fechamento do modal
        }
    });
</script>