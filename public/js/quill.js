const FontAttributor = Quill.import('attributors/class/font');
FontAttributor.whitelist = [
  'sans-serif', 'serif', 'roboto-mono', 'monospace', 'times', 
  'helvetica', 'arial', 'verdana', 'impact'
];
Quill.register(FontAttributor, true);

// Initialize Quill
var quill = new Quill('#editor-cadastro', {
  modules: {
    toolbar: '#toolbar-cadastro'    
  },
  placeholder: 'Escrever o conteúdo da notícia...',
  theme: 'snow'
});

// transfer div "editor" To textarea "hiddenTextarea"
$("form").on("submit", function() {
  $(".ql-clipboard").remove(); // because automatically generated
  $(".ql-tooltip").remove(); // because automatically generated
  $("#hiddenTextarea-cadastro").val($("#editor-cadastro").html());
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