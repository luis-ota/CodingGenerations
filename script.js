const menuIcon = document.querySelector('.menu-icon');
const menu = document.querySelector('.menu');

let isOpen = false;

menuIcon.addEventListener('click', () => {
    isOpen = !isOpen;
        if (isOpen) {
            menu.style.display = 'block';
        } else {
            menu.style.display = 'none';
        }
    });


document.getElementById("CadButton").addEventListener("click", function() {    
    window.location.href = "cadastro_aluno/index.php";
    });

document.getElementById("loginButton").addEventListener("click", function() {
       
        window.location.href = "index2.html";
        });

const carouselItems = document.querySelector('.carousel-inner');
const prevButton = document.querySelector('.carousel-control-prev');
const nextButton = document.querySelector('.carousel-control-next');
let currentIndex = 0;

nextButton.addEventListener('click', () => {
    currentIndex = (currentIndex < 2) ? currentIndex + 1 : 0;
    carouselItems.style.transform = `translateX(-${currentIndex * 100}%)`;
});

prevButton.addEventListener('click', () => {
    currentIndex = (currentIndex > 0) ? currentIndex - 1 : 2;
    carouselItems.style.transform = `translateX(-${currentIndex * 100}%)`;
});
    

 
        