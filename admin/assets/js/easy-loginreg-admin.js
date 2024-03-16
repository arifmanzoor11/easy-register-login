jQuery(document).ready(function ($) {
    jQuery('input#myprefix_media_manager').click(function (e) {
        e.preventDefault();
        var image_frame;
        if (image_frame) {
            image_frame.open();
        }
        // Define image_frame as wp.media object
        image_frame = wp.media({
            title: 'Select Media',
            multiple: false,
            library: {
                type: 'image',
            }
        });

        image_frame.on('close', function () {
            // On close, get selections and save to the hidden input
            // plus other AJAX stuff to refresh the image preview
            var selection = image_frame.state().get('selection');
            var gallery_ids = new Array();
            var my_index = 0;
            selection.each(function (attachment) {
                gallery_ids[my_index] = attachment['id'];
                my_index++;
            });
            var ids = gallery_ids.join(",");
            if (ids.length === 0) return true; //if closed withput selecting an image
            jQuery('input#myprefix_image_id').val(ids);
            Refresh_Image(ids);
        });

        image_frame.on('open', function () {
            // On open, get the id from the hidden input
            // and select the appropiate images in the media manager
            var selection = image_frame.state().get('selection');
            var ids = jQuery('input#myprefix_image_id').val().split(',');
            ids.forEach(function (id) {
                var attachment = wp.media.attachment(id);
                attachment.fetch();
                selection.add(attachment ? [attachment] : []);
            });

        });

        image_frame.open();
    });

});

// Ajax request to refresh the image preview
function Refresh_Image(the_id) {
    var data = {
        action: 'myprefix_get_image',
        id: the_id
    };

    jQuery.get(ajaxurl, data, function (response) {

        if (response.success === true) {
            jQuery('#myprefix-preview-image').replaceWith(response.data.image);
        }
    });
}










jQuery(document).ready(function ($) {
    jQuery('#myprefix_media_dashboard').click(function (e) {
        e.preventDefault();
        var image_frame;
        if (image_frame) {
            image_frame.open();
        }
        // Define image_frame as wp.media object
        image_frame = wp.media({
            title: 'Select Media',
            multiple: false,
            library: {
                type: 'image',
            }
        });

        image_frame.on('close', function () {
            // On close, get selections and save to the hidden input
            // plus other AJAX stuff to refresh the image preview
            var selection = image_frame.state().get('selection');
            var gallery_ids = new Array();
            var my_index = 0;
            selection.each(function (attachment) {
                gallery_ids[my_index] = attachment['id'];
                my_index++;
            });
            var ids = gallery_ids.join(",");
            if (ids.length === 0) return true; //if closed withput selecting an image
            jQuery('input#myprefix_image_id_dashbaord').val(ids);
            Refresh_Image(ids);
        });

        image_frame.on('open', function () {
            // On open, get the id from the hidden input
            // and select the appropiate images in the media manager
            var selection = image_frame.state().get('selection');
            var ids = jQuery('input#myprefix_image_id_dashbaord').val().split(',');
            ids.forEach(function (id) {
                var attachment = wp.media.attachment(id);
                attachment.fetch();
                selection.add(attachment ? [attachment] : []);
            });

        });

        image_frame.open();
    });

});

// Ajax request to refresh the image preview
function Refresh_Image(the_id) {
    var data = {
        action: 'myprefix_get_image',
        id: the_id
    };

    jQuery.get(ajaxurl, data, function (response) {

        if (response.success === true) {
            jQuery('#preview-image').replaceWith(response.data.image);
        }
    });
}


function esyLogin(evt, esy_Login) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("esylogin_content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("esylogin_links");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(esy_Login).style.display = "block";
    evt.currentTarget.className += " active";
}

var counter = 0;
jQuery("#rowAdder").click(function () {
    counter += 1;
    jQuery(".append_menu_select").attr("name", "dropdown_menu_" + counter);
    // jQuery(".append_menu_select").attr("value", "dropdown_menu_" + counter);
    var getMenu = document.getElementById('append_menu').innerHTML;
    // getMenu.val()
    console.log(getMenu);
    //
    // exit;
    newRowAdd =
        '<div id="row"> <div style=" display: flex; gap: 5px;margin-top:5px">' +
        '<div class="input-group-prepend">' +
        '<button class="button-primary woocommerce-save-button" id="DeleteRow" type="button">' +
        '<i class="bi bi-trash"></i> Delete</button> </div>' +
        '' + getMenu + ' </div> </div>';

    jQuery('#newinput').append(newRowAdd);

});
jQuery("body").on("click", "#DeleteRow", function () {
    jQuery(this).parents("#row").remove();
})