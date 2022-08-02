/**
 * @var {object} DIFFERED_SCRIPT_LOADING
 */

window.addEventListener('load', () => {
    setTimeout(() => {
        const tag = document.createElement('script');
        tag.src = DIFFERED_SCRIPT_LOADING.google_maps.src
        const firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }, DIFFERED_SCRIPT_LOADING.google_maps.delay);
});

function InitMap() {
    locations = [];
    GOOGLE_LOCATIONS_OBJ.forEach(function (e) {
        let latitude = e.google_map_locations_theme_options.lat;
        let longitude = e.google_map_locations_theme_options.lng;
        let zoom = e.google_map_locations_theme_options.zoom
        let map_email = e.contact_us_email_theme_options;
        let map_phone = e.contact_us_contact_number_theme_options;
        let map_image = e.map_image;
        let map_address = e.contact_us_address_theme_options;
        let map_addresse_link = 'https://www.google.com/maps/place/' + e.google_map_locations_theme_options.address + '/@' + e.google_map_locations_theme_options.value + ',' + zoom + 'z';

        let title = e.address_heading_theme_options;

        if( map_email != ''){
            var map_email_li =  '<li><a class="h5" href="mailto:' + map_email + '"><i class="fa-solid fa-envelope cmn-icon"></i>'
                + map_email +
                '</a></li>'
        }else{
            var map_email_li = '';
        }

        if( map_phone != ''){
            var map_phone_li =  '<li><a class="h5" href="tel:' + map_phone + '"><i class="fa-solid fa-phone cmn-icon"></i>' + map_phone + '</a>' +
                '</li>';
        }else{
            var map_phone_li = '';
        }

        if( map_address != ''){
            var map_address_li = '<li><a target="_blank" class="h5" href="' + map_addresse_link + '"><i class="fa-solid fa-location-dot cmn-icon"></i>' +
                map_address
                + '</a></li>'
        }else{
            var map_address_li = '';
        }
        
        const content =
            '<div id="content">' +
            '<img src="' + map_image + '" alt="">' +
            '<div id="siteNotice">' +
            "</div>" +
            '<div id="bodyContent">' +
            '<h5 id="firstHeading" class="text-blue firstHeading">'
            + title +
            '</h5>' +
            '<ul class="list-unstyled">' +
            map_address_li +
            map_phone_li +
            map_email_li +
            '</ul>' +
            "</div>";

        locations.push({
            name: content,
            latlng: new google.maps.LatLng(latitude, longitude)
        })
    });
    var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(0, 0),
        zoom: 0,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: [
            {
                "featureType": "administrative.province",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "color": "#fefefe"
                    },
                    {
                        "weight": "0.01"
                    },
                    {
                        "lightness": "-12"
                    },
                    {
                        "saturation": "-100"
                    },
                    {
                        "gamma": "4.78"
                    }
                ]
            },
            {
                "featureType": "administrative.neighborhood",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "color": "#ffffff"
                    },
                    {
                        "lightness": "100"
                    },
                    {
                        "gamma": "0.00"
                    },
                    {
                        "weight": "0.01"
                    }
                ]
            },
            {
                "featureType": "administrative.locality",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "color": "#ffffff"
                    },
                    {
                        "saturation": "-100"
                    },
                    {
                        "lightness": "56"
                    },
                    {
                        "gamma": "0.00"
                    },
                    {
                        "weight": "0.01"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "stylers": [
                    {
                        "color": "#024177"
                    }
                ]
            },
            {
                "featureType": "landscape.man_made",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#030b11"
                    },
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.attraction",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.business",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.government",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.medical",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.place_of_worship",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.school",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.sports_complex",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#030b11"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#2f85c6"
                    },
                    {
                        "weight": 0.5
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#3b80b7"
                    },
                    {
                        "weight": 0.5
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#85adcc"
                    },
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "labels.text",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "color": "#85adcc"
                    },
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.highway.controlled_access",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#3b80b7"
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "transit.line",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "transit.station.airport",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "transit.station.bus",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#030b11"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            }
        ]
    });
    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    var icon = {
        url: BLOG_LOCATIONS_OBJ[0] + "/assets/theme/img/map-dot-img.png", // url
        scaledSize: new google.maps.Size(50, 50), // scaled size
        origin: new google.maps.Point(0, 0), // origin
        anchor: new google.maps.Point(0, 0) // anchor
    };
    for (var i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: locations[i].latlng,
            map: map,
            icon: icon,
        });
        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent(locations[i].name);
                infowindow.open(map, marker);
                map.panTo(locations[i].latlng)
            }
        })(marker, i));
        google.maps.event.addListener(map, "click", function (event) {
            infowindow.close();
        });
    }
    var latlngbounds = new google.maps.LatLngBounds();
    for (var i = 0; i < locations.length; i++) {
        latlngbounds.extend(locations[i].latlng);
    }
    map.fitBounds(latlngbounds, 100);
}
