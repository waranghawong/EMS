function fill(Value) {
    $('#search').val(Value);
    $('#responsecontainer').hide();
 }
 $(document).ready(function() {
    $("#search").keyup(function() {
        var name = $('#search').val();
        if (name == "") {
            $.ajax({   
                type: "GET",
                url: "process/retrieveemployee.php",             
                dataType: "html",             
                success: function(response){                    
                        $("#responsecontainer").html(response); 
                }	
            });
        }
        else {
            $.ajax({
                type: "POST",
                url: "search.php",
                data: {
                    search: name
                },
                success: function(html) {
                    $("#responsecontainer").html(html).show();
                }
            });
        }
    });
 });