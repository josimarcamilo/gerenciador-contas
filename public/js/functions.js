var areaSelected = null;

function getAreas() {
  axios.get('/api/areas').then(function (res) {
    console.log(res.data);
    areaSelected = res.data;
  });
}