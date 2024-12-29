document.getElementById('report').addEventListener('click', function() {
    document.getElementById('reportForm').style.display = 'block';
    document.getElementById('overlay').style.display = 'block';
});

document.getElementById('overlay').addEventListener('click', function() {
    document.getElementById('reportForm').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
});