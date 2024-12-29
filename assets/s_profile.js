function toggleDropdown() {
    const dropdown = document.getElementById('statusDropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

function openPopup() {
    document.getElementById('infoPopup').style.display = 'flex';
}

function openDate(){
    document.getElementById('datePopup').style.display = 'flex';
}

function closePopup() {
    document.getElementById('infoPopup').style.display = 'none';
}

function closeDate(){
    document.getElementById('datePopup').style.display=  'none';
}

function showChallan(challanPath) {
    const challanPopup = document.getElementById('challanPopup');
    const challanImage = document.getElementById('challanImage');
    challanImage.src = challanPath;
    challanPopup.style.display = 'flex';
}

function closeChallanPopup() {
    const challanPopup = document.getElementById('challanPopup');
    challanPopup.style.display = 'none';
}