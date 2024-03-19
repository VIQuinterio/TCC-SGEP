const FontAttributor = Quill.import('attributors/class/font');
FontAttributor.whitelist = [
  'sans-serif', 'serif', 'roboto-mono', 'monospace', 'times', 
  'helvetica', 'arial', 'verdana', 'impact'
];
Quill.register(FontAttributor, true);
/*
var quill = new Quill('#editor-container', {  
  modules: {
    toolbar: '#toolbar'
  },
  placeholder: 'Escrever o conteúdo da notícia...',
  theme: 'snow'
});

quill.on('text-change', function(delta, oldDelta, source) {
  document.getElementById("editor-container").value = quill.root.innerHTML;
});

var quill_ed = new Quill('#editor', {  
  modules: {
    toolbar: '#toolbar-edit'
  },
  placeholder: 'Escrever o conteúdo da notícia...',
  theme: 'snow'
});

// Adiciona um ouvinte de evento para o envio do formulário
document.addEventListener('DOMContentLoaded', function() {
  const form = document.querySelector('#form_edicao');
  form.addEventListener('submit', function(event) {
      // Atualiza o valor do campo de conteúdo com o HTML do editor Quill
      document.querySelector('#conteudo').value = quill.root.innerHTML;
  });
});
*/
// Initialize Quill
var quill = new Quill('#editor-container', {
  modules: {
    toolbar: '#toolbar'    
  },
  placeholder: 'Escrever o conteúdo da notícia...',
  theme: 'snow'
});

// transfer div "editor" To textarea "hiddenTextarea"
$("form").on("submit", function() {
  $(".ql-clipboard").remove(); // because automatically generated
  $(".ql-tooltip").remove(); // because automatically generated
  $("#hiddenTextarea").val($("#editor-container").html());
});

// Transferir conteúdo do Quill para o campo de texto oculto ao enviar o formulário
$("form").on("submit", function() {
  var quillContent = quill.getText(); // Obter o conteúdo de texto do Quill
  $(".ql-clipboard").remove(); // because automatically generated
  $(".ql-tooltip").remove(); // because automatically generated
  $("#hiddenTextarea").val(quillContent); // Definir o valor do campo de texto oculto
});

// Inicializar o editor Quill
var quill = new Quill('#editor', {
  modules: {
    toolbar: '#toolbar-edit'    
  },
  placeholder: 'Escrever o conteúdo da notícia...',
  theme: 'snow'
});

const updateScroll = quill.scroll.update.bind(quill.scroll);
quill.scroll.update = (mutations, context) => {
  if (!quill.isEnabled()) {
    return;
  }
  updateScroll(mutations, context);
}

const scrollEnable = quill.scroll.enable.bind(quill.scroll);
quill.scroll.enable = (enabled = true) => {
  quill.container.classList.toggle("notranslate", enabled);
  scrollEnable(enabled);
};
quill.container.classList.toggle("notranslate", quill.isEnabled());