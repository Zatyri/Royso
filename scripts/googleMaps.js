const POI = [
  ['Flånvarpet', 60.225344944139316, 25.31857692401444],
  ['Hället/Hälle', 60.22658097813159, 25.320508114495546],
  ['Hällstens/Willförs udde', 60.22747600813417, 25.318019024542124],
  ['Brändholmskobben', 60.228605415877595, 25.320207707087377],
  ['Brändholmssundet/Brännholmssundet', 60.229372538565315, 25.31969272295908],
  ['Edisholmar', 60.23107719136673, 25.31767570178992],
  ['Tvillingsören/Tvillingsörn', 60.23094934548216, 25.31497203511637],
  ['Snällensviken', 60.22783827523471, 25.315529934588696],
  ['Lusören', 60.230352724759804, 25.3092642943611],
  ['Gräsören/Gräsörn', 60.2287971982328, 25.302054516564965],
  ['Gräsörshalsen', 60.22820053833135, 25.303170315509604],
  ['Gräsörsratena', 60.23050188095863, 25.30218326259704],
  ['Gräsörssundet', 60.22913814187123, 25.30003749539581],
  ['Kapellsten', 60.22990525209028, 25.302440754661188],
  ['Bänkholmen', 60.22728421804816, 25.30192577053289],
  ['Bänkholmsrate', 60.22736945822493, 25.300724140900204],
  ['Kattholmen/Kattholm', 60.22570723479311, 25.301153294340452],
  ['Gloholmen', 60.22464166261605, 25.30209743190899],
  ['Branthällarna/Branthällen', 60.22421542404648, 25.298578373698973],
  ['Sandviken/Skräddarnsviken', 60.2240662392378, 25.304114453078142],
  ['Gloet', 60.22538756677701, 25.309607617113294],
  ['Mynnet', 60.22532363279967, 25.305358998054857],
  ['Skrevan/ Träskmans Skrivun', 60.22338424289504, 25.3035136382618],
  ['Röysöbranten', 60.22214808836007, 25.30531608271084],
  ['Sandviken/Södervik', 60.220741373052036, 25.30750476525609],
  ['Ratena/Måsholmarna (Fyrkanten)', 60.218183554215756, 25.306303135623402],
  ['Långa ratet', 60.21752275191727, 25.310465923993792],
  ['Mellanratet', 60.21854592401601, 25.30832015679256],
  ['Första ratet', 60.21854592401601, 25.30741893456804],
  ['Andra ratet', 60.2178851290203, 25.307805172664263],
  ['Sillklacken', 60.218439345078714, 25.306903950439747],
  ['Fyrkanten', 60.21752275191727, 25.30879222557683],
  ['Fyrkantiggrundet', 60.21758670110882, 25.308191410760486],
  ['Höjterviken/ Höterviken', 60.22046428564885, 25.310895077434036],
  ['Höjtersundet/Hötersundet', 60.219206705695, 25.309092632985],
  ['Stora Munkholmen', 60.21720300408883, 25.313770405483684],
  ['Byxlåsudden', 60.218396713406804, 25.310337177961713],
  ['Lilla Munkholmen', 60.21941985823463, 25.314628712364176],
  ['Skomakarsundet', 60.220762687370666, 25.313341252043436],
  ['Långstrand', 60.22163656250435, 25.31784736316602],
  ['Koören/Köörn', 60.21829013398448, 25.32089435259177],
  ['Lilla Koören/Lilla Koörn/Ånkan', 60.2204429711362, 25.32153808275214],
  ['Högberget/Högis', 60.222915362179045, 25.31767570178992],
  ['Sandholmen', 60.22400230268338, 25.32668792403509],
  ['Sandholmssundet', 60.22611214313834, 25.328790775892298],
  ['Morfarsudden/Heikkisudden', 60.22517445303436, 25.321409336720063],
  ['Klesasbackan', 60.22366130562046, 25.311195484842212],
  ['Snokarberget', 60.21811960618824, 25.312096707066722],
  ['Stormklipporna', 60.22176444471653, 25.305101505990713],
];

initMap = () => {
  const mapProp = {
    center: {
      lat: 60.22437863713966,
      lng: 25.31604859754797,
    },
    zoom: 14,
  };
  const map = new google.maps.Map(
    document.getElementById('googleMap'),
    mapProp
  );

  const createMarker = (place, number) => {
    const label = (number + 1).toString();

    const info = new google.maps.InfoWindow({
      content: `<div class='googleInfo' style="font-weight:bold;">${place[0]}</div>`,
    });

    const marker = new google.maps.Marker({
      position: { lat: place[1], lng: place[2] },
      map,
      title: place[0],
      label: label,
    });

    marker.addListener('click', () => {
      info.open(map, marker);
    });

    return marker;
  };

  const markers = [];

  for (let i = 0; i < POI.length; i++) {
    const place = POI[i];
    markers.push(createMarker(place, i));
  }

  const markerClusterer = new MarkerClusterer(map, markers, {
    imagePath:
      'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m',
  });
};
