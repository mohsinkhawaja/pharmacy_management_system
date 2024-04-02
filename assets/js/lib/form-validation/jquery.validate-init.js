
var form_validation = function() {
    var e = function() {
            jQuery(".form-valide").validate({
                ignore: [],
                errorClass: "invalid-feedback animated fadeInDown",
                errorElement: "div",
                errorPlacement: function(e, a) {
                    jQuery(a).parents(".form-group > div").append(e)
                },
                highlight: function(e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                },
                success: function(e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                },
                rules: {
					"total_shalf": {
                         required: !0,
                        digits: !0
                    },
				"cup_name": {
                        required: !0,
                        minlength: 3
                    },
				"book_copies": {
                         required: !0,
                        digits: !0
                    },
				"book_isbn": {
                        required: !0,
                        minlength: 3
                    },
				"book_edition": {
                        required: !0,
                        minlength: 3
                    },
				"au_name": {
                        required: !0,
                        minlength: 3
                    },
					"book_name": {
                        required: !0,
                        minlength: 3
                    },
                    "val-username": {
                        required: !0,
                        minlength: 3
                    },
                    "val-email": {
                        required: !0,
                        email: !0
                    },
                    "val-password": {
                        required: !0,
                        minlength: 5
                    },
                    "val-confirm-password": {
                        required: !0,
                        equalTo: "#val-password"
                    },
                    "val-select2": {
                        required: !0
                    },
                    "val-select2-multiple": {
                        required: !0,
                        minlength: 2
                    },
                    "val-suggestions": {
                        required: !0,
                        minlength: 5
                    },
                    "val-skill": {
                        required: !0
                    },
                    "val-currency": {
                        required: !0,
                        currency: ["$", !0]
                    },
                    "val-website": {
                        required: !0,
                        url: !0
                    },
                    "val-phoneus": {
                        required: !0,
                        phoneUS: !0
                    },
                    "val-digits": {
                        required: !0,
                        digits: !0
                    },
                    "val-number": {
                        required: !0,
                        number: !0
                    },
                    "val-range": {
                        required: !0,
                        range: [1, 5]
                    },
                    "val-terms": {
                        required: !0
                    }
                },
                messages: {
					"total_shalf": {
                        required: "Please enter  No of Shelf",
                        minlength: "at least 3 characters"
                    },
				"cup_name": {
                        required: "Please enter  Cupboard Name",
                        minlength: "at least 3 characters"
                    },
				"book_copies": {
                        required: "Please enter  No of Copies",
                        minlength: "at least 3 characters"
                    },
				"book_isbn": {
                        required: "Please enter  ISBN No",
                        minlength: "at least 3 characters"
                    },
				"book_edition": {
                        required: "Please enter  Edition",
                        minlength: " at least 3 characters"
                    },
				"au_name": {
                        required: "Please enter  Author Name",
                        minlength: "Author Name must consist of at least 3 characters"
                    },
					"book_name": {
                        required: "Please enter a bookname",
                        minlength: "Your bookname must consist of at least 3 characters"
                    },
                    "val-username": {
                        required: "Please enter a username",
                        minlength: "Your username must consist of at least 3 characters"
                    },
                    "val-email": "Please enter a valid email address",
                    "val-password": {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    "val-confirm-password": {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    },
                    "val-select2": "Please select a value!",
                    "val-select2-multiple": "Please select at least 2 values!",
                    "val-suggestions": "What can we do to become better?",
                    "val-skill": "Please select a Shelf!",
                    "val-currency": "Please enter a price!",
                    "val-website": "Please enter your website!",
                    "val-phoneus": "Please enter a US phone!",
                    "val-digits": "Please enter only digits!",
                    "val-number": "Please enter a number!",
                    "val-range": "Please enter a number between 1 and 5!",
                    "val-terms": "You must agree to the service terms!"
                }
            })
        }
    return {
        init: function() {
            e(), a(), jQuery(".js-select2").on("change", function() {
                jQuery(this).valid()
            })
        }
    }
}();
jQuery(function() {
    form_validation.init()
});