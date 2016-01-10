/*
**  to show the second menu and populate cat_parent2
*/
var count = 0;
alert(++count);
$(document).ready(function() {
  $("#cat_parent").on("change", function() { 
    $.ajax({
        type : 'POST',
        // send $_POST["cat_parent"] and csrf token name for csrf security
        data : 'cat_parent='+ $('#cat_parent').val() +'&' + 'csrf_test_name='+ $("input[name=csrf_test_name]").val() +'',
        url  : base_url('index.php')+'Category/get_category_json',
        dataType : 'json',
        beforeSend :  function() {
                        $("#Loading").show().html("<center>Loading</center>");
                      },
        success : function(data) {
                    on_success(data);
                  },
    });
  }); 
});
 // success function for second select dropdown
function on_success(data) {
  $("#new_dropdown").css("visibility", "visible"); // set visible the select menu
  $("#cat_parent2").html(""); // set select menu empty again
  $.each(data, function(i,element){ // add elements to menu
    $("#cat_parent2").append($("<option>").text(element.cat_name).attr("value", element.cat_id));
  });
}

// just a side function to get base_url of the website
function base_url(segment){
   // get the segments
   pathArray = window.location.pathname.split( '/' );
   // find where the segment is located
   indexOfSegment = pathArray.indexOf(segment);
   // make base_url be the origin plus the path to the segment
   return window.location.origin + pathArray.slice(0,indexOfSegment).join('/') + '/';
}