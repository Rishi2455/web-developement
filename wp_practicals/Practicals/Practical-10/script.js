let date = document.createElement("div");
date.className = "date";
date.innerHTML = new Date().toLocaleDateString("en-UK", {
  year: "numeric",
  month: "numeric",
  day: "numeric",
});
document.body.appendChild(date);