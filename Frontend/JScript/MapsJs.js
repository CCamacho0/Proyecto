function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        mapTypeControl: false,
        center: {lat: -33.8688, lng: 151.2195},
        zoom: 7,
    });

    new AutocompleteDirectionsHandler(map);
}

class AutocompleteDirectionsHandler {
    map;
    originPlaceId;
    destinationPlaceId;
    travelMode;
    directionsService;
    directionsRenderer;
    constructor(map) {
        this.map = map;
        this.originPlaceId = "";
        this.destinationPlaceId = "";
        this.travelMode = google.maps.TravelMode.DRIVING;
        this.directionsService = new google.maps.DirectionsService();
        this.directionsRenderer = new google.maps.DirectionsRenderer();
        this.directionsRenderer.setMap(map);

        const originInput = document.getElementById("origin-input");
        const destinationInput = document.getElementById("destination-input");

        const originAutocomplete = new google.maps.places.Autocomplete(originInput);

        // Specify just the place data fields that you need.
        originAutocomplete.setFields(["place_id"]);

        const destinationAutocomplete = new google.maps.places.Autocomplete(
                destinationInput
                );

        // Specify just the place data fields that you need.
        destinationAutocomplete.setFields(["place_id"]);

        this.setupPlaceChangedListener(originAutocomplete, "ORIG");
        this.setupPlaceChangedListener(destinationAutocomplete, "DEST");
        this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
        this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(
                destinationInput
                );
        this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);
    }
    // Sets a listener on a radio button to change the filter type on Places
    // Autocomplete.

    setupPlaceChangedListener(autocomplete, mode) {
        autocomplete.bindTo("bounds", this.map);
        autocomplete.addListener("place_changed", () => {
            const place = autocomplete.getPlace();

            if (!place.place_id) {
                window.alert("Please select an option from the dropdown list.");
                return;
            }

            if (mode === "ORIG") {
                this.originPlaceId = place.place_id;
            } else {
                this.destinationPlaceId = place.place_id;
            }

            this.route();
        });
    }
    route() {
        if (!this.originPlaceId || !this.destinationPlaceId) {
            return;
        }

        const me = this;

        this.directionsService.route(
                {
                    origin: {placeId: this.originPlaceId},
                    destination: {placeId: this.destinationPlaceId},
                    travelMode: this.travelMode,
                },
                (response, status) => {
            if (status === "OK") {

                var route = response.routes[0];
                var duration = 0;
                var horas = 0;
                var minutos = 0;
                var Precio = 0;

                route.legs.forEach(function (leg) {
                    duration += leg.duration.value;
                });
                me.directionsRenderer.setDirections(response);

                duration = duration / 8;
                Precio = duration * 0.01;
                Precio = Precio.toFixed(2);

                duration = duration / 60;
                duration = duration / 60;
                horas = duration;

                horas = Math.floor(duration);
                minutos = duration - horas;
                minutos = minutos * 60;
                minutos = Math.floor(minutos);

                if (horas < 10 && minutos < 10) {
                    document.getElementById("duracion").value = "0" + horas + ":0" + minutos;
                } else if (horas < 10) {
                    document.getElementById("duracion").value = "0" + horas + ":" + minutos;
                } else {
                    document.getElementById("duracion").value = horas + ":" + minutos;
                }
                document.getElementById("precio").value = Precio;

            } else {
                window.alert("Directions request failed due to " + status);
            }
        }
        );
    }
}

