function setLocation() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(getPosition);
	} else {
		alert("Geolocation is not supported by this browser.");
	}
}

function getPosition(position) {
	window.location.href = "hungry.php?longitude="+position.coords.longitude+"&latitude="+position.coords.latitude;
}

setLocation();
