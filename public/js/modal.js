function initilize_popup() {
    $(".table__row").each(function (){

    })
    const close_popup = () => {
        $("body, html").removeClass("modal-open");
        $(".modal-backdrop").removeClass("in");
        $(".modal").fadeOut();
        $(".modal").removeClass("in");
    }

    $("button.close, .modal-footer button.btn").click(function (e) {
        close_popup();
    });
    $('.fade').click(function(evt) {
        if (evt.currentTarget === evt.target) {
            close_popup();
        }
    })
}
