// Obtém uma lista de todos os botões para abrir modais
const openModalButtons = document.querySelectorAll('.open-modal-button');

// Adiciona um evento de clique a cada botão
openModalButtons.forEach(button => {
    button.addEventListener('click', function() {
        // Obtém o ID do modal a ser aberto a partir do atributo data
        const modalId = this.getAttribute('data-modal-target');

        // Obtém uma referência para o modal usando o ID
        const modal = document.getElementById(modalId);

        // Remove a classe 'hidden' para exibir o modal
        modal.classList.remove('hidden');
    });
});