$(document).ready(function () {
  const mymap = L.map('mapid').setView([0, 0], 2);

  const attribution = 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
  const tileUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaWxtYW1mYXV6aSIsImEiOiJjazh2amlvZWUwbWc5M2VwNjN2bWQ1a2t4In0.5ONwpTqU6pGqx0QXtyoxUg';
  const tiles = L.tileLayer(tileUrl, {
    attribution,
    maxZoom: 18,
    id: 'mapbox/outdoors-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiaWxtYW1mYXV6aSIsImEiOiJjazh2amlvZWUwbWc5M2VwNjN2bWQ1a2t4In0.5ONwpTqU6pGqx0QXtyoxUg'
  });
  tiles.addTo(mymap);

  $.ajax({
    url: 'https://api.kawalcorona.com/',
    type: 'GET',
    async: true,
    dataType: 'json',
    success: function (response) {
      $.each(response, function (i, data) {
        if (response[i].attributes.Lat != null && response[i].attributes.Long_ != null) {
          const lat = response[i].attributes.Lat;
          const lng = response[i].attributes.Long_;
          const marker = L.marker([lat, lng], {}).addTo(mymap);
          const negara = response[i].attributes.Country_Region;
          const positif = response[i].attributes.Confirmed;
          const sembuh = response[i].attributes.Recovered;
          const meninggal = response[i].attributes.Deaths;

          marker.bindPopup(
            `<b>` + negara + `<br />
            Positif : </b>` + positif + `<br />
            <b>Sembuh : </b>` + sembuh + `<br />
            <b>Meninggal : </b>` + meninggal
          ).openPopup();
        }
      });
    }
  });
});