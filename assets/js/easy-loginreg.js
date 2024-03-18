jQuery(document).ready(function () {
    jQuery("#easy-login-form").submit(function (e) {
        jQuery(".loading-img").show();
        e.preventDefault();
        jQuery.ajax({
            url: my_ajax_object.ajax_url,
            type: "POST",
            // dataType: 'json',
            data: {
                'action': 'easy_get_login',
                'username': jQuery("#username").val(),
                'password': jQuery("#txtPassword").val(),
                'security': jQuery('#security').val()
            },
            success: function (data) {
                // console.log(data);
                var data_Success = jQuery.parseJSON(data);
                if (data_Success.Success == '400') {
                    // console.log(data_Success.Content);
                    jQuery("#vote_counter").html(data_Success.Content);
                    jQuery(".loading-img").hide();
                    jQuery("#vote_counter").show().delay(7000).fadeOut();

                } if (data_Success.Success == '200') {
                    jQuery("#vote_counter").html(data_Success.Content);
                    jQuery("#vote_counter").show().delay(5000).fadeOut();
                    window.setTimeout('location.reload()', 3000);
                    jQuery(".loading-img").hide();

                }
                // jQuery("#vote_counter").html(data.Content);
            },
            error: function (xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                console.log('Error - ' + errorMessage);
            }
        })
    });
    jQuery("#reg-form").submit(function (e) {
        jQuery(".loading-img").show();
        e.preventDefault();
        var Form_Data = jQuery("#reg-form").serialize();
        // console.log(Form_Data);
        // return;
        jQuery.ajax({
            url: my_ajax_object.ajax_url,
            type: "POST",
            data: Form_Data + '&action=register_user',
            success: function (data) {
               
                var data_Success = jQuery.parseJSON(data);
                if (data_Success.Code == '150') {
                    jQuery("#reg-form").after("<div class='reg-loader'>"+ data_Success.Value +"</div>");
                    jQuery(".reg-loader").show(1000).delay(5000).hide( "fast");
                }
                if (data_Success.Code == '200') {
                    jQuery("#reg-form").after("<div class='reg-loader' style='background:green'>"+ data_Success.Value +"</div>");
                    jQuery(".reg-loader").show(1000).delay(10000).hide( "fast");
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                console.log('Error - ' + errorMessage);
            }
        })
    });
    
}

);

jQuery(document).ready(function () {
    jQuery(".profile").click(function () {
        jQuery(".dropdownmenu").toggle();
    });
});

// passwordInput.addEventListener('keyup', checkInput, false);
