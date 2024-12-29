const content = document.getElementById('content');

function loadPage(page) {

    const xhr = new XMLHttpRequest();
    xhr.open('GET', page, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            let script = document.createElement('script');
            script.src = '../assets/update.js';
            document.body.appendChild(script);
            document.getElementById('content').innerHTML = xhr.responseText;
        } else {
            document.getElementById('content').innerHTML = `<p> Unable to load ${xhr.error}</p>`;
        }
    }
    xhr.onerror = () => {
        document.getElementById('content').innerHTML = `<p>Error loading page ${xhr.status}</p>`;
    }
    xhr.send();

}


const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');
const body = document.body;
const toggleBtn = document.getElementById('toggleBtn');
const closeIcon = document.getElementById('close-icon');


function openSidebar() {
    sidebar.classList.add('active');
    overlay.classList.add('active');
    body.classList.add('no-scroll');
}

function closeSidebar() {
    sidebar.classList.remove('active');
    overlay.classList.remove('active');
    body.classList.remove('no-scroll');
}

toggleBtn.addEventListener('click', () => {
    if (sidebar.classList.contains('active')) {
        closeSidebar();
    } else {
        openSidebar();
    }
});

overlay.addEventListener('click', closeSidebar);

closeIcon.addEventListener('click', closeSidebar);

window.addEventListener('resize', () => {
    if (window.innerWidth > 1000) {
        sidebar.classList.add('active');
        overlay.classList.remove('active');
        body.classList.remove('no-scroll');
    } else {
        sidebar.classList.remove('active');
    }
});
