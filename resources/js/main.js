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

    $('input[type=text]').on('change', function() {
        updateTextView($(this));
    });
});

$(function() {
    $(".div-preview").css({ "padding-top": "-50%" });
    // $().animate();
});

function update() {
    var update_text = document.getElementById("bid_form").value;

    document.getElementById("bid_form").value = update_text.toLocaleString();

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

function updateTextView(_obj) {
    var num = getNumber(_obj.val());
    if (num == 0) {
        _obj.val('');
    } else {
        _obj.val(num.toLocaleString());
    }
}

function getNumber(_str) {
    var arr = _str.split('');
    var out = new Array();
    for (var cnt = 0; cnt < arr.length; cnt++) {
        if (isNaN(arr[cnt]) == false) {
            out.push(arr[cnt]);
        }
    }
    return Number(out.join(''));
}

function update_image() {
    var player_id = document.getElementById("player_name").value;

    var img_src = 'https://cdn.nba.com/headshots/nba/latest/1040x760/' + player_id + '.png';
    document.getElementById("preview").src = img_src;
    var image = document.getElementById('preview');
    image.onerror = function() {
        // alert('error loading ' + this.src);
        this.src = 'https://raw.githubusercontent.com/gtkacz/nba-headshot-api/main/img/unknown-1.png';
    };

    var stats_href = 'https://www.nba.com/stats/player/' + player_id;
    document.getElementById("player_stats").href = stats_href;
}