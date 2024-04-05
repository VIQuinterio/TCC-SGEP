// Crie um mapa Leaflet e adicione-o à div com id 'map'
const map = L.map('map').setView([-14.2350, -51.9253], 4); // Coordenadas do Brasil

// Adicione uma camada de mapa base
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Lista para armazenar as coordenadas dos marcadores
const markerCoords = [];

// Geocodificação usando o serviço Nominatim
document.querySelectorAll('#unidades [data-endereco]').forEach(elem => {
    const endereco = elem.dataset.endereco;
    const municipio = elem.dataset.municipio;

    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${endereco}, ${municipio}, Brazil`)
        .then(response => response.json())
        .then(data => {
            // Verifique se a resposta tem resultados
            if (data && data.length > 0) {
                const latitude = data[0].lat;
                const longitude = data[0].lon;

                // Adicione um marcador à posição
                L.marker([latitude, longitude]).addTo(map)
                    .bindPopup('Localização: ' + endereco);

                // Armazene as coordenadas do marcador
                markerCoords.push([latitude, longitude]);
            } else {
                console.error('Nenhum resultado de geocodificação encontrado.');
            }

            // Verifique se todas as unidades foram processadas
            if (markerCoords.length === document.querySelectorAll('#unidades [data-endereco]').length) {
                // Calcule a visualização média para englobar todos os marcadores
                const bounds = L.latLngBounds(markerCoords);

                // Ajuste a visualização do mapa para englobar todos os marcadores
                map.fitBounds(bounds);
            }
        })
        .catch(error => {
            console.error('Erro ao fazer a solicitação de geocodificação:', error);
        });
});