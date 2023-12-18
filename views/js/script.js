const toggleButton = document.querySelector('.toggle-button');
const sideNav = document.querySelector('.side-nav');
const mainContent = document.querySelector('.main-content');
window.onload = () => {
    if (typeof Storage !== 'undefined') {
        let mode = window.localStorage.getItem('sidenav');
        if (mode !== null) {
            if (mode === 'open') {
                toggleButton.classList.toggle('open');
                toggleButton.setAttribute("title", "Seitenleiste schliessen");
                sideNav.classList.toggle('open');
                mainContent.classList.toggle('shift');
            }
        }
    }
};


toggleButton.addEventListener('click', () => {
    toggleButton.classList.toggle('open');
    sideNav.classList.toggle('open');
    mainContent.classList.toggle('shift');
    if (typeof Storage !== 'undefined') {
        if (sideNav.classList.contains('open')) {
            window.localStorage.setItem('sidenav', 'open');
            toggleButton.setAttribute("title", "Seitenleiste schliessen");
        } else {
            window.localStorage.setItem('sidenav', 'closed');
            toggleButton.setAttribute("title", "Seitenleiste anzeigen");
        }

    }
});

document.addEventListener(
    'click',
    function (event) {

        if (!event.target.matches('.copypaste')) {
            if (event.target.id == "shellcommand") {
                document.getElementById('shellcommand').remove();
            }
            return;
        }

        if (!navigator.clipboard) {
            // Clipboard API not available
            return;
        }
        const text = event.target.value;

        try {
            //event.target.select();
            navigator.clipboard.writeText(text);
            document.getElementById('copy-status').innerText = 'Copied to clipboard';
            setTimeout(function () {
                document.getElementById('copy-status').innerText = '';
            }, 1200);
        } catch (err) {
            console.error('Failed to copy!', err);
        }


    },
    false
);
