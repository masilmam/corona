const mymap = L.map('mapid').setView([0, 0], 2);

// const marker = L.marker([0, 0], {}).addTo(mymap);

const attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>';
const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
const tiles = L.tileLayer(tileUrl, {
  attribution
});
tiles.addTo(mymap);

$.ajax({
  url: 'https://api.kawalcorona.com/',
  type: 'GET',
  async: true,
  dataType: 'json',
  success: function (response) {
    $.each(response, function (i, data) {
      // console.log(response[i].attributes.Country_Region);
      const negara = response[i].attributes.Country_Region;
      const positif = response[i].attributes.Confirmed;
      const sembuh = response[i].attributes.Recovered;
      const meninggal = response[i].attributes.Deaths;
      const lat = response[i].attributes.Lat;
      const lng = response[i].attributes.Long_;
      const marker = L.marker([lat, lng], {}).addTo(mymap);

      marker.bindPopup(`<b>` + negara + `<br />
      Positif : </b>` + positif + `<br />
      <b>Sembuh : </b>` + sembuh + `<br />
      <b>Meninggal : </b>` + meninggal).openPopup();
    });
  }
});

$(document).ready(function () {

});

//marker
// const lat = 50.5;
// const lng = 30.5;
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