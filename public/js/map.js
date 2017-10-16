var gbounds, infoWin2, infoWin, timerHandle;

function isInfoWindowOpen(infoWindow) {
	if ((infoWindow == 'undefined') || (typeof (infoWindow) == 'undefined'))
		return false;
	var map = infoWindow.getMap();
	return (map !== null && typeof map !== "undefined");
}

function showData(evt, content) {
	if (infoWin)
		infoWin.close();
	var latlng = evt.latLng;
	latlng = new google.maps.LatLng(latlng.lat(), latlng.lng());
	infoWin = new google.maps.InfoWindow({
		content : content,
		position : latlng,
		pixelOffset : new google.maps.Size(0, -15),
	});
	infoWin.open(gmap);
}

function polygonMouseOver(evt) {
	if (isInfoWindowOpen(infoWin2))
		return;
	var content = '<div id="content">' + this.distirct.name ;
	
	if (this.distirct.deputy) {
		var deputy = this.distirct.deputy;
		content += '<br>' + deputy.full_name + '<br>';
	}

	content += '</div>';
	timerHandle = clearTimeout(timerHandle);
	setTimeout(showData(evt, content), 1000);

	this.setOptions({
		fillColor : '#a7d4d1'
	});
}

function polygonMouseOut(evt) {
	if (infoWin)
		infoWin.close();
	this.setOptions({
		fillColor : '#bcebe7'
	});
}

function polygonMouseClick(evt) {
	var content = '<div id="content"><div><center>'
			+ this.distirct.name 
			+ '</center></div></div>';
	if (infoWin)
		infoWin.close();
	if (infoWin2)
		infoWin2.close();
	infoWin2 = new google.maps.InfoWindow({
		content : content,
		position : evt.latLng,
		maxWidth : 200,
		pixelOffset : new google.maps.Size(0, -15),
	});
	infoWin2.open(gmap);
}

function olpoly2gpoly(olpoly, feature) {
	var olrings = olpoly.getLinearRings();
	var gpoly = new google.maps.Polygon({
		distirct: feature,
		strokeWeight : 1,
		strokeColor: '#779997',
		fillOpacity : 0.5,
		fillColor : '#bcebe7'
	});
	var grings = new google.maps.MVCArray();
	for (var k = 0; k < olrings.length; k++) {
		var olcoords = olrings[k].getCoordinates();
		var gring = new google.maps.MVCArray();
		for (n = 0; n < olcoords.length; n++) {
			var coord = olcoords[n];
			var latlon = new google.maps.LatLng(coord[1], coord[0]);
			if (!gbounds)
				gbounds = new google.maps.LatLngBounds(latlon, latlon);
			else
				gbounds.extend(latlon);
			gring.push(latlon);
		}
		grings.push(gring);
	}
	gpoly.setPaths(grings);
	gpoly.setMap(gmap);
	return gpoly;
}

function drawDistricts(data) {
	var wkt = new ol.format.WKT();
	var features = JSON.parse(atob(data));
	var zoom = 11;
console.log(features[43]);
	for (var i = 0; i < features.length; i++) {
		var lbl = features[i]['num'];
		var feature = wkt.readFeature(features[i]['polygon']);
		var geom = feature.getGeometry();
		if (geom instanceof ol.geom.MultiPolygon) {
			var polys = geom.getPolygons();
			for (var j = 0; j < polys.length; j++) {
				var olpoly = polys[j];
				var gpoly = olpoly2gpoly(olpoly, features[i]);
				google.maps.event.addListener(gpoly, 'mousemove',
						polygonMouseOver);
				google.maps.event.addListener(gpoly, 'mouseout',
						polygonMouseOut);

				google.maps.event
						.addListener(gpoly, 'click', polygonMouseClick);
			}
		}
	}
	
	var center = gbounds.getCenter();
	gmap.setZoom(zoom);
	gmap.setCenter(center);
}
