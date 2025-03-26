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
    jQuery(document).ready(function ($) {
        $("#reg-form").on("submit", function (e) {
            e.preventDefault();
    
            $(".loading-img").show(); // Show loading image
            var formData = $(this).serialize() + "&action=register_user";
    
            console.log(formData); // Debugging
    
            $.ajax({
                url: my_ajax_object.ajax_url,
                type: "POST",
                data: formData,
                dataType: "json", // Expect JSON response
                success: function (response) {
                    $(".loading-img").hide(); // Hide loading image
    
                    $(".reg-loader").remove(); // Remove any existing messages before inserting a new one
                    
                    var messageClass = response.Code == "200" ? "reg-loader success" : "reg-loader error";
                    var messageBg = response.Code == "200" ? "background: green;" : "background: red;";
    
                    var messageDiv = $("<div>", {
                        class: messageClass,
                        text: response.Value,
                        style: messageBg,
                    });
    
                    $("#reg-form").after(messageDiv);
                    $(".reg-loader").fadeIn(1000).delay(response.Code == "200" ? 10000 : 5000).fadeOut("fast");
                },
                error: function (xhr, status, error) {
                    $(".loading-img").hide(); // Hide loading image on error
                    console.error("AJAX Error:", xhr.status, xhr.statusText, error);
                }
            });
        });
    });
    
    
}

);

jQuery(document).ready(function () {
    jQuery(".profile").click(function () {
        jQuery(".dropdownmenu").toggle();
    });
});

// passwordInput.addEventListener('keyup', checkInput, false);
