function displayInfo() {
  var name = document.getElementById("name").value;
  var dob = document.getElementById("dob").value;
  var gender = document.querySelector('input[name="gender"]:checked')?.value;
  var email = document.getElementById("email").value;
  var mobile = document.getElementById("mobile").value;
  var address = document.getElementById("address").value;
  var state = document.getElementById("state").value;

  // Collect education checkboxes
  var educations = [];
  var educationElements = document.querySelectorAll(
    'input[name="education"]:checked'
  );
  educationElements.forEach(function (el) {
    educations.push(el.value);
  });

  var outputText =
    "Full Name: " +
    name +
    "\n" +
    "Date of Birth: " +
    dob +
    "\n" +
    "Gender: " +
    gender +
    "\n" +
    "Email ID: " +
    email +
    "\n" +
    "Mobile No.: " +
    mobile +
    "\n" +
    "Address: " +
    address +
    "\n" +
    "State: " +
    state +
    "\n" +
    "Education: " +
    educations.join(", ");

  document.getElementById("output").value = outputText;
}
