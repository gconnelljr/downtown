$(function(){
	
$('#map').livequery(function() {
	if (typeof EventBars == 'undefined') return;

	var h = $('#bars_list').height() - 10;
	if (h> 400) {
		$('#map_cont').height(h);
	}

	function getMarkerIcon(type, num, num_bars) {
		console.log(num_bars);
		if (num_bars <= 26) {
			return 'http://www.google.com/intl/en_ALL/mapfiles/marker_' + type + num + '.png';
		} else {
			return 'http://maps.google.com/intl/en_us/mapfiles/ms/micons/' + type + '-dot.png'; // large pin
			//return 'http://labs.google.com/ridefinder/images/mm_20_' + type + '.png' // small pin
		}
	}

	function makeMarker(map, item, icon) {
		return new google.maps.Marker({
			map: map,
			draggable: false,
			animation: google.maps.Animation.DROP,
			position: item.latlng,
			title: item.title,
			icon: icon
		});
	}

	var map = GMAP('#map', function() {
		
		return EventBars.map(function(r) {
			return {
				title: r.venue_name,
				is_registration_point: r.is_registration_point,
				html: r.address,
				latlng: new google.maps.LatLng(r.lat, r.lng),
				num_bars: EventBars.length
			};
		});

	},  { 
		
	setMarker: function(i, item) {
			console.log(item);
			if(item.latlng.hb != 0 && item.latlng.ib != 0) {
				var type = (item.is_registration_point == 1) ? 'yellow' : 'green',
					n = String.fromCharCode(65 + i),
					icon = getMarkerIcon(type, n, item.num_bars),
					marker = makeMarker(this.data.map, item, icon);

				this.data.mapBounds.extend(marker.position);
				this.methods.setMarkerClick(marker, item);
			}
		} 

	}).init();

});


});