
$(".all").click(function () {
    lesson_id = $(".all").val();
    lesson_rec = $(".rec").val();
    lesson_pdf = $(".pdf").val();
});



$(".btn_val").click(function () {
    data = $(".btn_val").val();
    AjaxMethod({"action":"download","data":data},function () {
        
    });
});


