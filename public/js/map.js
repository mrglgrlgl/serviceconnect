document.addEventListener('DOMContentLoaded', function () {
    var map = L.map('map').setView([10.6713, 122.9511], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker([10.6713, 122.9511]).addTo(map)
        .bindPopup('Aaaaa.')
        .openPopup();
});