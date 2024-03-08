document.addEventListener("DOMContentLoaded", function() {
    const sortIcons = document.querySelectorAll(".sort-icon");
    
    sortIcons.forEach(icon => {
        icon.addEventListener("click", function(event) {
            event.preventDefault();
            const column = icon.closest("th").dataset.sortBy;
            const sortOrder = icon.classList.contains("sorted-desc") ? "asc" : "desc";
            
            // Realize a lógica de ordenação aqui, e atualize a tabela conforme necessário
            console.log("Ordenar pela coluna", column, "em ordem", sortOrder);
            
            // Remova as classes de ordenação de todas as colunas
            sortIcons.forEach(icon => {
                icon.classList.remove("sorted-asc", "sorted-desc");
            });
            
            // Adicione a classe de ordenação à coluna clicada
            icon.classList.toggle("sorted-asc", sortOrder === "asc");
            icon.classList.toggle("sorted-desc", sortOrder === "desc");
        });
    });
});
