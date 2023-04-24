$(document).ready(function () {

    //menu rating
    $(".menuWrap").find(".range").on("input change", function (e) {
        $(this).parents(".menuWrap").find(".rangeV").html($(this).val());
    });
    $(".rate").on("click", function (e) {
        var self = this;
        var findIt = $(self).parents(".menuWrap");
        $.ajax({
            type: "POST",
            url: "assets/fixed/rateAction.php",
            data: {
                idMenu: findIt.find(".idMenu").val(),
                ratingValue: findIt.find(".range").val()
            },
            success: function name(response) {
                if (response.success) {
                    findIt.find(".rating").html(response.data);
                    findIt.find(".rateMessage").html(response.message);
                }
            },
            error: function (response) {
                if (response.status == 400) {
                    findIt.find(".rateMessage").html(response.responseJSON.message);
                }
            }
        });
    });
    //validation form
    $("form#registarForm").on("submit", function (event) {
        var html = "";
        var firstName = $("input[type='text'][name='fName']");
        var lastName = $("input[type='text'][name='lName']");
        var email = $("input[type='email'][name='email']");
        var password = $("input[type='password'][name='password']");
        var gender = $("input[type='radio'][name='gender']:checked");
        var address = $("input[type='text'][name='address']");
        var register = [firstName, lastName, email, password, gender, address];
        //regex
        var reName = /^([A-ZĐŽŠČĆ][a-zđžščć]{2,20})+$/; //at least 3 characters and first letter upper and max 20 characters with Serbian alphabet
        var reEmail = /^[a-z][\w\.]*\@[a-z0-9]{3,20}(\.[a-z]{3,5})?\.[a-z]{2,3}$/;
        var rePassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[.@$!%*?&])[A-Za-z\d@$!%*?&.]{8,}$/;
        var reGender = /^(female|male)$/;
        var reAddress = /^[A-Z][a-z]*[\s\w]+$/; //start with first letter upper
        var regex = [reName, reName, reEmail, rePassword, reGender, reAddress];
        var validator = 0;
        var errors = ["First name must have first letters uppercase and minimum 3 letters in total.",
            "Last name must have first letters uppercase and minimum 3 letters in total.",
            "Email is required.",
            "Password must have minimum 8 caracters which have 1 upper case, 1 lower case, number and special caracter.",
            "Gender is required.",
            "Address start with first letter upper."
        ];
        for (let i = 0; i < register.length; i++) {
            const element = register[i];
            const reg = regex[i];
            const error = errors[i];
            if (!reg.test(element.val())) {
                if (element != gender) {
                    element.html("");
                }
                element.next("p").html(error);
                element.addClass("borderRed");
                element.next("p").addClass("textRed");
                validator++;
            } else {
                if (element != gender) {
                    element.html("");
                }
                element.next("p").html("");
                element.removeClass("borderRed");
                element.next("p").removeClass("textRed");
            }
        }
        if (validator != 0) {
            html = `<p>Fill form correctly</p>`;
            $("#reggisterConfirm").addClass("alert alert-danger");
            $("#registerConfirm").html(html);
            event.preventDefault();
        }
    });
    //book validation
    $("#bookForm").on("submit", function (eventBook) {
        var html = "";
        var firstName = $("input[type='text'][name='fName']").val();
        var lastName = $("input[type='text'][name='lName']").val();
        var email = $("input[type='email'][name='email']").val();
        var number = $("input[type='number'][name='number']").val();
        var date = $("input[type='date'][name='date']").val();
        var time = $("input[type='time'][name='time']").val();
        var message = $("textarea[name='message']").val();
        //regex
        var reName = /^[A-ZĐŽŠČĆ][a-zđžščć]{2,20}$/;
        var reEmail = /^[a-z][\w\.]*\@[a-z0-9]{3,20}(\.[a-z]{3,5})?\.[a-z]{2,3}$/;
        var reNumber = /^[0-9]{7,11}$/;
        var today = new Date();
        var reDate = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);
        console.log(date.val());
        console.log(reDate);
        console.log(message);
        var reTime = /^(0[8-9]|1[0-9]|2[0-0]):[0-5][0-9]$/;
        var reText = /^[A-z][\w\s\.,?!]*$/;
        var validatorBook = 0;
        var bookValidation = [{
            value: firstName,
            regex: reName,
            error: "First name is required. First name must have at least 3 characters and first letter upper and max 20 characters."
        }, {
            value: lastName,
            regex: reName,
            error: "Last name is required. Last name must have at least 3 characters and first letter upper and max 20 characters."
        }, {
            value: email,
            regex: reEmail,
            error: "Email is required."
        }, {
            value: parseInt(number),
            regex: reNumber,
            error: "Number must have min 7 numbers and max 11 numbers."
        }, {
            value: message,
            regex: reText,
            error: "Message is not in text format."
        }];
        for (let i = 0; i < bookValidation.length; i++) {
            if (bookValidation[i].value == message) {
                continue;
            }
            if (!bookValidation[i].regex.test(bookValidation[i].value)) {
                bookValidation[i].value.html("");
                bookValidation[i].value.next("p").html(bookValidation[i].error);
                bookValidation[i].value.addClass("borderRed");
                bookValidation[i].value.next("p").addClass("textRed");
                validatorBook++;
                console.log(bookValidation[i]);
            } else {
                bookValidation[i].value.html("");
                bookValidation[i].value.next("p").html("");
                bookValidation[i].value.removeClass("borderRed");
                bookValidation[i].value.next("p").removeClass("textRed");
            }
        }
        if (!date) {
            date.next("p").html("Please book date that isn't in past.");
            date.addClass("borderRed");
            date.next("p").addClass("textRed");
            console.log(validatorBook);
            validatorBook++;
        } else if ((date) < reDate) {
            date.next("p").html("Please book date that isn't in past.");
            date.addClass("borderRed");
            date.next("p").addClass("textRed");

            console.log(validatorBook);
            validatorBook++;
            console.log(date);
            
        } else {
            date.next("p").html("");
            date.removeClass("borderRed");
            date.next("p").removeClass("textRed");
        }
        console.log(validatorBook);
        console.log(date);
        if (validatorBook != 0) {
            html = `<p>Fill form correctly</p>`;
            $("#bookConfirm").addClass("alert alert-danger");
            $("#bookConfirm").html(html);
            eventBook.preventDefault();
        }
        eventBook.preventDefault();
    });
    //login validation
    $("#loginForm").on("submit", function (event) {
        var html = "";
        var email = $("input[type='email'][name='email']");
        var password = $("input[type='password'][name='password']");
        //regex
        var reEmail = /^[a-z][\w\.]*\@[a-z0-9]{3,20}(\.[a-z]{3,5})?\.[a-z]{2,3}$/;
        var rePassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[.@$!%*?&])[A-Za-z\d@$!%*?&.]{8,}$/;
        var validator = 0;
        var loginValidation = [{
            value: email,
            regex: reEmail,
            error: "Email is required."
        }, {
            value: password,
            regex: rePassword,
            error: "Password must have minimum 8 caracters which have 1 upper case, 1 lower case, number and special caracter."
        }];
        for (let i = 0; i < loginValidation.length; i++) {
            if (!loginValidation[i].regex.test(loginValidation[i].value.val())) {
                loginValidation[i].value.html("");
                loginValidation[i].value.next("p").html(loginValidation[i].error);
                loginValidation[i].value.addClass("borderRed");
                loginValidation[i].value.next("p").addClass("textRed");
                validator++;
            } else {
                loginValidation[i].value.html("");
                loginValidation[i].value.next("p").html("");
                loginValidation[i].value.removeClass("borderRed");
                loginValidation[i].value.next("p").removeClass("textRed");
            }
        }
        if (validator != 0) {
            html = `<p>Fill form correctly</p>`;
            $("#loginConfirm").addClass("alert alert-danger");
            $("#loginConfirm").html(html);
            event.preventDefault();
        }
    });
});
//search and pagination
$(document).on("click", ".page-link, #bthSearchMenu", function (e) {
    var text = $("#searchMenu").val();
    var selfPag = this;
    var findIdPag = $(selfPag).data("dt-idx");
    var user = $(selfPag).data("user") ? true : false;
    $.ajax({
        type: "POST",
        url: "assets/fixed/searchPaginationAction.php",
        data: {
            idPag: findIdPag,
            searchText: text
        },
        success: function name(response) {
            var html = "";
            console.log(response.success);
            if (response.success) {
                console.log(response.message);
                console.log(response.data);
                console.log(response.dataPage);
                if (response.dataPage > 1) {
                    let pagMenu = document.querySelector("#paginationMenu");
                    while (pagMenu.firstChild) {
                        pagMenu.removeChild(pagMenu.lastChild);
                    }
                    let elementDiv = document.createElement("div");
                    elementDiv.classList.add("m-2");
                    pagMenu.appendChild(elementDiv);
                    let elementUl = document.createElement("ul");
                    elementUl.classList.add("pagination");
                    elementDiv.appendChild(elementUl);
                    for (let i = 1; i <= response.dataPage; i++) {
                        let elementLi = document.createElement("li");
                        elementLi.classList.add("paginate_button", "page-item", "active");
                        elementUl.appendChild(elementLi);
                        let elementButton = document.createElement("button");
                        elementButton.classList.add("page-link", "my-color");
                        elementButton.setAttribute("aria-controls", "dataTable");
                        elementButton.setAttribute("data-user", user ? "true" : "false");
                        elementButton.setAttribute("data-dt-idx", `${i}`);
                        elementButton.setAttribute("tabindex", "0");
                        elementButton.innerHTML = `${i}`;
                        elementLi.appendChild(elementButton);
                    }
                } else {
                    console.log(response.messagePage);
                    document.querySelector("#paginationMenu").innerHTML = "";
                }
                if (response.data == null) {
                    console.log("123");
                    $("#menu").addClass("d-flex justify-content-center my-color")
                    $("#menu").html(response.message);
                } else {
                    $.each(response.data, function (index, value) {
                        html += `<div class="col-lg-4 d-flex ">
                                    <div class="services-wrap d-flex menuWrap">
                                        <img class="img imgSrc" src="images/${value.srcImgMenu}.${value.extImgMenu}" alt="${value.altImgMenu}" />
                                        <div class="text p-4">
                                            <h3>${value.nameMenu}</h3>
                                            <p>${value.descMenu}</p>
                                            <p class="price">
                                            <p>Price: $${value.priceMenu}</p>
                                            </p>
                                            <p>
                                                <span>Rating: </span>
                                                <span class="rating">${(Math.round(value.average*100)/100).toFixed(1)}</span>
                                            </p>`
                        if (user) {
                            html += `<p>
                                                <span>Rate: </span>
                                                <span class="rangeV">5</span>
                                                <input type="hidden" class="idMenu" name="idMenu" value="${value.idMenu}" />
                                                <input type="range" min="0" max="5" value="5" class="range" />
                                            </p>
                                            <button class="rate btn btn-primary">Rate</button>
                                            <p class="rateMessage"></p>`
                        }
                        html += `</div>
                                    </div>
                                </div>`;
                    });

                    document.querySelector("#responseText").innerHTML = "";
                }
            } else {
                document.querySelector("#paginationMenu").innerHTML = "";
                document.querySelector("#menu").innerHTML = "";
                console.log(response.message);
                document.querySelector("#responseText").innerHTML = response.message;
                document.querySelector("#responseText").classList.add("d-flex", "justify-content-center", "my-color", "mt-4");
            }
            $("#menu").html(html);
        }
    });
});