const updateBtn = document.getElementById("updateBtn");
const updatedate = document.getElementById("updatedate");
updatedate.style.display = "none";
updateBtn.addEventListener("click", function (event) {
    event.preventDefault();

    if (updatedate.style.display === "none") {
        updatedate.style.display = "block";
        sendUpdateForm.style.display = 'none';
    } else {
        updatedate.style.display = "none";
    }
});


const sendUpdateBtn = document.getElementById("sendUpdateBtn");
const sendUpdateForm = document.getElementById("sendUpdateForm");
sendUpdateForm.style.display = "none";

sendUpdateBtn.addEventListener("click", function (event) {
    event.preventDefault();
    if (sendUpdateForm.style.display === "none") {
        sendUpdateForm.style.display = 'block';
        updatedate.style.display = "none";
    } else {
        sendUpdateForm.style.display = "none";
    }
});
