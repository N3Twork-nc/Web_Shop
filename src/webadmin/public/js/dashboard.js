// const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');

// sideLinks.forEach(item => {
//     const li = item.parentElement;
//     item.addEventListener('click', () => {
//         sideLinks.forEach(i => {
//             i.parentElement.classList.remove('active');
//         })
//         li.classList.add('active');
//     })
// });

const menuBar = document.querySelector('.content nav .bx.bx-menu');
const sideBar = document.querySelector('.sidebar');

const savedSidebarState = localStorage.getItem('sidebarState');

if (savedSidebarState) {
    sideBar.classList.toggle('close', savedSidebarState === 'closed');
}

menuBar.addEventListener('click', () => {
    sideBar.classList.toggle('close');
    const sidebarState = sideBar.classList.contains('close') ? 'closed' : 'open';
    localStorage.setItem('sidebarState', sidebarState);
});

const searchBtn = document.querySelector('.content nav form .form-input button');
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
const searchForm = document.querySelector('.content nav form');

searchBtn.addEventListener('click', function(e) {
    if (window.innerWidth < 576) {
        e.preventDefault;
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchBtnIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});

window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        sideBar.classList.add('close');
    } else {
        sideBar.classList.remove('close');
    }
    if (window.innerWidth > 576) {
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});

const toggler = document.getElementById('theme-toggle');

const savedTheme = localStorage.getItem('theme');

if (savedTheme) {
    if (savedTheme === 'dark') {
        document.getElementById('theme-toggle').checked = true;
    }
    document.body.classList.add(savedTheme);
} else {
    document.body.classList.add('light');
}

toggler.addEventListener('change', function() {
    if (this.checked) {
        document.body.classList.add('dark');
        document.body.classList.remove('light');
        localStorage.setItem('theme', 'dark');
    } else {
        document.body.classList.remove('dark');
        document.body.classList.add('light');
        localStorage.setItem('theme', 'light');
    }
});

window.addEventListener('beforeunload', function() {
    localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
});

window.addEventListener('storage', function(event) {
    if (event.key === 'theme') {
        const updatedTheme = event.newValue;
        document.body.classList.remove('dark', 'light');
        document.body.classList.add(updatedTheme);
        setTimeout(() => {
            if (updatedTheme === 'dark') {
                document.getElementById('theme-toggle').checked = true;
            } else {
                document.getElementById('theme-toggle').checked = false;
            }
        }, 1000);
    }
});