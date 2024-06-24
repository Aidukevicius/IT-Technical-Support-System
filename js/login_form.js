document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("login-form");
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");
    const usernameError = document.querySelector("#username + .error__field");
    const passwordError = document.querySelector("#password + .error__field");

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

    const validateForm = () => {
        const usernameValue = usernameInput.value.trim();
        const passwordValue = passwordInput.value.trim();

        let isFormValid = true;

        if (usernameValue === "") {
            setMessage(messageType.ERROR, usernameInput, "Username is required");
            isFormValid = false;
        } else {
            setMessage(messageType.SUCCESS, usernameInput);
        }

        if (passwordValue === "") {
            setMessage(messageType.ERROR, passwordInput, "Password is required");
            isFormValid = false;
        } else {
            setMessage(messageType.SUCCESS, passwordInput);
        }

        return isFormValid; 
    };

    loginForm.addEventListener("submit", (e) => {
        if (!validateForm()) {
            e.preventDefault(); 
        }
    });

});
