// ==============================
// Welcome Message - Home Page
// ==============================

window.onload = function () {

    // Display personalized welcome message on Home page
    let welcomeMessage = document.getElementById("welcomeMessage");

    if (welcomeMessage) {

        let userName = prompt("Welcome! Please enter your name:");

        if (userName !== null && userName.trim() !== "") {

            welcomeMessage.innerHTML =
                "Welcome to our online Library, <strong>" +
                userName + "  Explore thousands of educational books, " +
                "digital resources, and research materials tailored for your success. " +
                "We are glad to support your learning journey today!"
                "</strong>!";

        } else {

            welcomeMessage.innerHTML =
                "Welcome to our online Library! Explore thousands of educational books, " +
                "digital resources, and research materials tailored for your success. " +
                "We are glad to support your learning journey today!";

        }
    }


    // ==============================
    // Form Validation (Contact Form Only)
    // ==============================

    let forms = document.querySelectorAll("form");

    forms.forEach(function (form) {

        form.addEventListener("submit", function (event) {

            let valid = true;

            // Remove previous error borders AND outlines
            let fields = form.querySelectorAll("input, select, textarea");

            fields.forEach(function (field) {
                field.style.border = "";
                field.style.outline = "";
            });


            // ==============================
            // Check normal required fields (text, email, tel, textarea)
            // ==============================

            let requiredFields = form.querySelectorAll(
                "input[required]:not([type='radio']):not([type='checkbox']), select[required], textarea[required]"
            );

            requiredFields.forEach(function (field) {

                if (field.value.trim() === "") {

                    valid = false;
                    field.style.border = "2px solid red";

                }

            });


            // ==============================
            // Check required radio buttons
            // ==============================

            let radioGroups = {};

            form.querySelectorAll("input[type='radio'][required]").forEach(function (radio) {

                if (!radioGroups[radio.name]) {
                    radioGroups[radio.name] = false;
                }

                if (radio.checked) {
                    radioGroups[radio.name] = true;
                }

            });


            for (let group in radioGroups) {

                if (!radioGroups[group]) {

                    valid = false;

                    form.querySelectorAll(
                        "input[type='radio'][name='" + group + "']"
                    ).forEach(function (radio) {

                        radio.style.outline = "2px solid red";

                    });

                }

            }


            // ==============================
            // Handle Validation Outcome
            // ==============================

            if (!valid) {

                // Stop form submission if invalid
                event.preventDefault();

                alert("Please complete all required fields correctly before submitting.");

            }
            // If valid, the form submits directly to PHP (process_contacts.php)

        });

    });

};


// ==============================
// Dynamic Feature 1
// Show / Hide Information
// ==============================

function toggleInfo() {

    let info = document.getElementById("extraInfo");

    if (info) {

        if (info.style.display === "none" || info.style.display === "") {

            info.style.display = "block";

        } else {

            info.style.display = "none";

        }

    }

}


// ==============================
// Dynamic Feature 2
// Change Heading
// ==============================

function changeHeading() {

    let heading = document.getElementById("mainHeading");

    if (heading) {

        heading.textContent =
            "Thank You for Visiting Lagos Library!";

        heading.style.color = "green";

    }

}
