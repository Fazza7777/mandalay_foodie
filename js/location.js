var x = document.getElementById("demo")
    $("#location-text").hide()
    $(".current").change(function(){

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
        $("#location-text").show()
     
    })

    function showPosition(position) {
        $("#lati").val(position.coords.latitude)
        $("#longi").val(position.coords.longitude)
 
    }
    $(".manual").change(function(){
        $("#lati").val("")
        $("#longi").val("")
        $("#location-text").show()
    })