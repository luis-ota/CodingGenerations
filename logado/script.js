document.addEventListener('DOMContentLoaded', function() {
    const hamburgerButton = document.querySelector('.hamburger-button');
    const sidebar = document.querySelector('.sidebar');

    hamburgerButton.addEventListener('click', function() {
        if(sidebar.style.visibility === 'visible'){
            sidebar.style.display = 'block';
            sidebar.style.visibility = 'hidden';
        }else{
            sidebar.style.visibility = 'visible'
        }
    });
});
