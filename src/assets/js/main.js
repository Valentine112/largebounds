(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$(".toggle-password").click(function() {

	  $(this).toggleClass("fa-eye fa-eye-slash");
	  var input = $("#password");
	  if (input.attr("type") == "password") {
	    input.attr("type", "text");
	  } else {
	    input.attr("type", "password");
	  }
	});

})(jQuery);


function res(type, message) {
    return `<div class="alert alert-${type} py-1">${message}</div>`
}

async function log(self, type) {
    let error = ""
    let email = ""
    let password = ""
    let username = ""
    let fullname = ""

    var data = {
        part: "user",
        action: type,
        val: {

        }
    }

    const message = document.getElementById("message")

    if(type == "register") {
        username = document.getElementById("username")
        fullname = document.getElementById("fullname")

        fullname.value.trim().length < 1 ? error = "fullname" :
        username.value.trim().length < 1 ? error = "username" : null

        if(error != "") message.innerHTML = res("warning", "Please fill the forms")

        error == "username" ? username.focus() : 
        error == "fullname" ? fullname.focus() : null

        if(error != "") return

		var url = window.location.href
        var params = (new URL(url)).searchParams
        var referred = params.get('referred')

        if(referred === null) {
            referred = ""
        }

        data.val['fullname'] = fullname.value
        data.val['username'] = username.value
		data.val['referred'] = referred

    }
    if(type == "login" || "reister" || "forgot") {
        email = document.getElementById("email")
        if(email.value.trim().length < 6) {
            error = "email"
            message.innerHTML = res("warning", "Invalid email address")
            email.focus()

            return
        }else{
            data.val['email'] = email.value
        }
    }
    if(type == "login" || "register" || "change") {
        password = document.getElementById("password")

        if(password.value.trim().length < 7) {
            error = "password"
            message.innerHTML = res("warning", "Password should be atleast 7 characters")
            password.focus()

            return
        }else{
            data.val['password'] = password.value
        }
    }

    // Proceed with sending the values and the path
    message.innerHTML = ""
    new Func().buttonConfig(self, "before")

    new Func().request("request.php", JSON.stringify(data), 'json')
    .then(val => {
        new Func().buttonConfig(self, "after")
        console.log(val)
        if(val.status === 1) {
            //proceed to login
            window.location = type == ("register" | "password") ? "login" : type == "login" ? "user/home" : null
        }

        new Func().notice_box(val)
    })

}