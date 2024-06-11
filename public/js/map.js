/*// Crie um mapa Leaflet e adicione-o à div com id 'map'
const map = L.map('map').setView([-14.2350, -51.9253], 4); // Coordenadas do Brasil

// Adicione uma camada de mapa base
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

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

                // Ajuste a visualização do mapa para o centro do município
                map.setView([latitude, longitude], 10); // Zoom nível 10 (ajuste conforme necessário)
            } else {
                console.error('Nenhum resultado de geocodificação encontrado.');
            }
        })
        .catch(error => {
            console.error('Erro ao fazer a solicitação de geocodificação:', error);
        });
});
*/

function initMap() {
    const brasil = { lat: -14.2350, lng: -51.9253 };
    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: brasil
    });

    document.querySelectorAll('#unidades [data-endereco]').forEach(elem => {
        const endereco = elem.dataset.endereco;
        const municipio = elem.dataset.municipio;
        const geocoder = new google.maps.Geocoder();

        geocoder.geocode({ address: `${endereco}, ${municipio}, Brazil` }, (results, status) => {
            if (status === 'OK') {
                const location = results[0].geometry.location;
                new google.maps.Marker({
                    position: location,
                    map: map,
                    title: `Localização: ${endereco}`
                });
                map.setCenter(location);
                map.setZoom(10); // Ajuste o nível de zoom conforme necessário
            } else {
                console.error('Geocodificação falhou devido a: ' + status);
            }
        });
    });
}

// Inicia o mapa quando a página é carregada
window.onload = initMap;