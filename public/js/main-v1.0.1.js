$(document).ready(function(){
    // Materialise Init Functions
    $('.fixed-action-btn').floatingActionButton();
    $('input#input_text, textarea#textarea2').characterCounter();
    $('.modal').modal();


    $('#gotit').on('click', removeCard);
    function removeCard() {
        $('#cardInfo').remove();
    }

    var toast = $('input[name=\'toast\']').val();
    
    if (toast != '') {
        var toastArr = toast.split(",");
        var toastCheck = toastArr.length;
        var link = "";
        if (toastCheck > 1) link = '<a class="btn-flat toast-action" href="' + toastArr[1] +'">Undo</a>';
        var toastHTML = '<span>' + toastArr[0] + '</span>' + link;
        M.toast({html: toastHTML});
    }
    
});