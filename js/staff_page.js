document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form");
    const firstName = document.getElementById("firstname");
    const location = document.getElementById("location");
    const description = document.getElementById("description");
    const email = document.getElementById("email");
    const formSubmitted = document.getElementById("form-submitted").value === 'true';

    const messageType = {
        ERROR: "ERROR",
        SUCCESS: "SUCCESS",
    };

    const setMessage = (type, element, message = "") => {
        const inputGroup = element.parentElement;
        const errorField = inputGroup.querySelector(".error__field");

        switch (type) {
            case messageType.ERROR:
                errorField.innerText = message;
                inputGroup.classList.add("error");
                break;
            case messageType.SUCCESS:
            default:
                errorField.innerText = "";
                inputGroup.classList.remove("error");
                break;
        }
    };

    const isValidEmail = (val) => {
        return val.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/);
    };

    const validateForm = () => {
        const firstNameValue = firstName.value.trim();
        const locationValue = location.value.trim();
        const descriptionValue = description.value.trim();
        const emailValue = email.value.trim();

        let isFormValid = true;

        if (firstNameValue === "") {
            setMessage(messageType.ERROR, firstName, "First Name is required");
            isFormValid = false;
        } else {
            setMessage(messageType.SUCCESS, firstName);
        }

        if (locationValue === "") {
            setMessage(messageType.ERROR, location, "Location is required");
            isFormValid = false;
        } else {
            setMessage(messageType.SUCCESS, location);
        }

        if (descriptionValue === "") {
            setMessage(messageType.ERROR, description, "Description is required");
            isFormValid = false;
        } else {
            setMessage(messageType.SUCCESS, description);
        }

        if (emailValue === "") {
            setMessage(messageType.ERROR, email, "Email is required");
            isFormValid = false;
        } else if (!isValidEmail(emailValue)) {
            setMessage(messageType.ERROR, email, "Email is invalid");
            isFormValid = false;
        } else {
            setMessage(messageType.SUCCESS, email);
        }

        return isFormValid; 
    };

    form.addEventListener("submit", (e) => {
        if (!validateForm()) {
            e.preventDefault(); 
        }
    });
});
