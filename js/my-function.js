//var MaximumSizeOfFile = (1024 * 1024) * 3;

$(document).ready(function () {
    customDatatable();
    customPace();
    customCardBoxBealtiful();
    //customElevateZoom();
    //initApp();
    validateDefault();
    $(".fancybox").fancybox({
        //'width': 400,
        //'height': 300,
        'autoSize': false});
});

window.addEvent('domready', function () {
    /* LazyLoad instance */
    var lazyloader = new LazyLoad({
        range: 200,
        realSrcAttribute: "data-src",
        useFade: true,
        elements: '.lazyload',
        container: window
    });
});


$(document).on('click', 'a[href!="#"]', function (e) {
    Pace.restart();
});

$(document).ajaxStart(function () {
    Pace.restart();
});
Pace.on("start", function () {
    $("div.paceDiv").show();
});

Pace.on("done", function () {
    $("div.paceDiv").hide();
});



$.extend(true, $.fn.dataTable.defaults, {
    "language": {
        "sProcessing": "กำลังดำเนินการ...",
        "sLengthMenu": "แสดง_MENU_ แถว",
        "sZeroRecords": "ไม่พบข้อมูล",
        "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
        "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
        "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
        "sInfoPostFix": "",
        "sSearch": "ค้นหา:",
        "sUrl": "",
        "oPaginate": {
            "sFirst": "เิริ่มต้น",
            "sPrevious": "ก่อนหน้า",
            "sNext": "ถัดไป",
            "sLast": "สุดท้าย"
        }
    }
});
function customDatatable() {
    $('table').DataTable();
}
function initApp() {
    $('select.form-control').each(function (index, select) {
        $(this).find('option').eq('0').before($('<option></option>').val('').html('-- กรุณาเลือก --').prop('selected', true));

    });

}

function customPace() {
    paceOptions = {
        // Configuration goes here. Example:
        elements: false,
        restartOnPushState: false,
        restartOnRequestAfter: false
    }
}

function readURL(input) {
    var type = input.files[0].type;
    var size = input.files[0].size;
    var lastModified = input.files[0].lastModified;
    var name = input.files[0].name;
    var types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/JPEG', 'image/JPG', 'image/PNG', 'image/GIF'];
    if (input.files && input.files[0]) {
        if (types.indexOf(type) > -1) {
            if (size < MaximumSizeOfFile) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imgMain').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                alert('Please upload Maximun ' + MaximumSizeOfFile + ' kb');
            }

        } else {
            alert('Please upload files type [.jpeg,.png,.gif]');
        }
    } else {

    }
}

function validateDefault() {
    $.validator.setDefaults({
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error').css({'font-weight': 'bold'})
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
    });
}
function customCardBoxBealtiful() {
    var panelCards = $('.box-card');
    $.each(panelCards, function (index, card) {
        var maxLength = 50;
        var name = $.trim($(card).find('strong.title').text());
        var price = $(card).find('p.pull-left').text();
        var date = $(card).find('p.pull-right').text();
        //console.log('------------------------------------------');
       // console.log(' name ::==' + name);
        //console.log('name.length ::==' + name.length)
        //console.log('------------------------------------------');
        if (name.length < 35) {
            $(card).find('panel-body').find('.col-lg-12').eq(0).append('<br/>');
            var targetObj = $(card).find('div.panel-body').find('strong');
            //$('<br/>').insertBefore(targetObj);
            name += " ";
            for (var i = 0; i < maxLength; i++) {
                name += "\u00A0";
            }
            targetObj.text(name);
            $(card).find('strong.title').css({'font-size': '1.2em'});
        } else {
            $(card).find('strong.title').css({'font-size': '1.4em'});
        }

    });
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1);
        if (c.indexOf(name) == 0)
            return c.substring(name.length, c.length);
    }
    return "";
}




