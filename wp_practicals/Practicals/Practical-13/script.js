function validateForm() {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const mobile = document.getElementById("mobile").value.trim();
    let isValid = true;

    document.getElementById("nameError").innerText = "";
    document.getElementById("emailError").innerText = "";
    document.getElementById("mobileError").innerText = "";

    if (name === "") {
        document.getElementById("nameError").innerText = "Name is required.";
        isValid = false;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email === "") {
        document.getElementById("emailError").innerText = "Email is required.";
        isValid = false;
    } else if (!emailPattern.test(email)) {
        document.getElementById("emailError").innerText = "Invalid email format.";
        isValid = false;
    }

    const mobilePattern = /^[0-9]{10}$/;
    if (mobile === "") {
        document.getElementById("mobileError").innerText = "Mobile number is required.";
        isValid = false;
    } else if (!mobilePattern.test(mobile)) {
        document.getElementById("mobileError").innerText = "Mobile number must be 10 digits.";
        isValid = false;
    }

    return isValid;
}

document.getElementById("myForm").addEventListener("submit", function (event) {
    if (!validateForm()) {
        event.preventDefault();
    }
});