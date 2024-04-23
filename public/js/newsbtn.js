document.addEventListener("DOMContentLoaded", function() {
    // Selecionar elementos relevantes
    const newsList = document.getElementById("news-list");
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");

    // Variável para controlar o índice da primeira notícia exibida
    let startIndex = 0;

    // Manipulador de evento para o botão "Anterior"
    prevBtn.addEventListener("click", function() {
        // Atualizar o índice da primeira notícia exibida
        startIndex = Math.max(startIndex - 3, 0);
        // Renderizar as notícias com base no novo índice
        renderNews();
    });

    // Manipulador de evento para o botão "Próxima"
    nextBtn.addEventListener("click", function() {
        // Atualizar o índice da primeira notícia exibida
        if (startIndex + 3 < newsList.children.length) {
            startIndex += 3;
            // Renderizar as notícias com base no novo índice
            renderNews();
        }
    });

    // Função para renderizar as notícias com base no índice atual
    function renderNews() {
        // Ocultar todas as notícias
        Array.from(newsList.children).forEach(function(newsItem) {
            newsItem.style.display = "none";
        });
        // Exibir as próximas 4 notícias com base no índice atual
        for (let i = startIndex; i < Math.min(startIndex + 3, newsList.children.length); i++) {
            newsList.children[i].style.display = "block";
        }
    }

    // Renderizar as notícias iniciais
    renderNews();
});