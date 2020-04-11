$(document).ready(function () {
  const mymap = L.map('mapid').setView([0, 0], 2);

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
        if (response[i].attributes.Lat != null && response[i].attributes.Long_ != null) {
          const lat = response[i].attributes.Lat;
          const lng = response[i].attributes.Long_;
          const marker = L.marker([lat, lng], {}).addTo(mymap);
          const negara = response[i].attributes.Country_Region;
          const positif = response[i].attributes.Confirmed;
          const sembuh = response[i].attributes.Recovered;
          const meninggal = response[i].attributes.Deaths;

          function showPopup() {
            this.bindPopup(
              `<b>` + negara + `<br />
              Positif : </b>` + positif + `<br />
              <b>Sembuh : </b>` + sembuh + `<br />
              <b>Meninggal : </b>` + meninggal
            ).openPopup();
          }

          $(marker).click(showPopup);
        }
      });
    }
  });
});