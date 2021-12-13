const container = document.querySelector(".container");
const seats = document.querySelectorAll(".row .seat:not(.sold)");
const count = document.getElementById("count");
const total = document.getElementById("total");
const seatSelect = document.getElementById("ticket_type");

populateUI();

let ticketPrice = +seatSelect.value;

// Save indice del tipo de tiquete y el precio 
function setSeatData(seatIndex, seatPrice) {
    localStorage.setItem("selectedSeatIndex", seatIndex);
    localStorage.setItem("selectedSeatPrice", seatPrice);
}

    
// Get data from localstorage and populate UI
function populateUI() {
    const selectedSeats = JSON.parse(localStorage.getItem("selectedSeats"));

    if (selectedSeats !== null && selectedSeats.length > 0) {
        seats.forEach((seat, index) => {
            if (selectedSeats.indexOf(index) > -1) {
                seat.classList.add("selected");
            }
        });
    }

    const selectedSeatIndex = localStorage.getItem("selectedMovieIndex");

    if (selectedSeatIndex !== null) {
        seatSelect.selectedIndex = selectedSeatIndex;
    }
}

// Movie select event
seatSelect.addEventListener("change", (e) => {
    ticketPrice = +e.target.value;
    setSeatData(e.target.selectedIndex, e.target.value);
});

// Seat click event
container.addEventListener("click", (e) => {
    if (
            e.target.classList.contains("seat") &&
            !e.target.classList.contains("sold")
            ) {
        e.target.classList.toggle("selected");
        
    }
});


function recibeAsientos(){
    
    var asientos = new Array(90);
    
    for (var i = 0; i < asientos.length; i++) {
        
        document.getElementsByClassName("seat");
        asientos = asientos[i];
        
    }    
    
    
}



