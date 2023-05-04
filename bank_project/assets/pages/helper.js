
function AjaxMethod(parameters, successCallback) {
    $.ajax({
        type: 'POST',
        url: './api.php',
        data: JSON.stringify(parameters),
        contentType: 'application/json;',
        dataType: 'json',
        success: successCallback,
        error: function(xhr, textStatus, errorThrown) {
            console.error("can't process the request");
        }
    });
}

$("#logout").click(function(){
    AjaxMethod({"action":"logout"},function (data) {
        console.log(data.data);
        window.location.assign("./index.php")
      });
  });