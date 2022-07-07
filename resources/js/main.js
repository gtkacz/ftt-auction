$(document).on('change', '.div-toggle', function() {
    var target = $(this).data('target');
    var show = $("option:selected", this).data('show');
    $(target).children().addClass('hide');
    $(target).children().prop('required', false);
    $(target).removeClass('form-item');
    $(show).removeClass('hide');
    $(show).prop('required', true);
    $(show).parent().addClass('form-item');
});

$(document).ready(function() {
    $('.div-toggle').trigger('change');
    document.getElementById('bid_value').value = 'new value';
});

$(function() {
    $(".div-preview").css({ "padding-top": "-50%" });
    // $().animate();
});

function update(source, target) {
    var update_text = document.getElementById(source).value;

    if (update_text == "") {
        document.getElementById(target).textContent = "Placeholder";
        document.getElementById(target).style.color = "gray";
    } else {
        switch (source) {
            case "price":
                update_text = "Price: " + update_text + " $";
                break;
            case "size":
                update_text = "Size: " + update_text + " MB";
                break;
            case "weight":
                update_text = "Weight: " + update_text + " KG";
                break;
            case "width":
            case "length":
            case "height":
                var text1 = document.getElementById("height").value;
                var text2 = document.getElementById("width").value;
                var text3 = document.getElementById("length").value;
                update_text = "Dimension: " + text1 + "x" + text2 + "x" + text3;
                break;
        }
        document.getElementById(target).textContent = update_text;
        document.getElementById(target).style.color = "black";
    }
}

function check_active() {
    var checkboxes = document.querySelectorAll('#delete-checkbox:checked');
    var activebtn = document.getElementById('delete-product-btn');

    if (checkboxes.length > 0) {
        activebtn.disabled = 0;
    } else {
        activebtn.disabled = 1;
    }
}