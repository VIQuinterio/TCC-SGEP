function initMap() {
    const enderecoElem = document.getElementById('endereco');
    const endereco = enderecoElem.getAttribute('data-endereco');
    const municipio = enderecoElem.getAttribute('data-municipio');
    const geocoder = new google.maps.Geocoder();
    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: { lat: -14.2350, lng: -51.9253 } // Coordenadas do Brasil
    });

    geocoder.geocode({ address: `${endereco}, ${municipio}, Brazil` }, (results, status) => {
        if (status === 'OK') {
            const location = results[0].geometry.location;
            new google.maps.Marker({
                position: location,
                map: map,
                title: `Localização: ${endereco}`
            });
            map.setCenter(location);
        } else {
            console.error('Geocodificação falhou devido a: ' + status);
        }
    });
}

// Inicia o mapa quando a página é carregada
window.onload = initMap;
