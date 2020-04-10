const mymap = L.map('mapid').setView([0, 0], 2);

// const marker = L.marker([0, 0], {
//   draggable: true
// }).addTo(mymap);

const attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>';
const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
const tiles = L.tileLayer(tileUrl, {
  attribution
});
tiles.addTo(mymap);

const lat = 50.5;
const lng = 30.5;
// marker.setLatLng([lat, lng]);
// mymap.setView([lat, lng], 12);

// function putMarker() {
//   marker.on('dragend', function(e) {
//     $("#lat").val(this.getLatLng().lat);
//     $("#lng").val(this.getLatLng().lng);
//   });
// }

// $(document).ready(function() {
//   putMarker();
// });