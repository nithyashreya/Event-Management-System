// Select elements
const hamburger = document.getElementById('hamburger');
const menuOverlay = document.getElementById('menuOverlay');
const closeBtn = document.getElementById('closeBtn');

// Open menu on hamburger click
hamburger.addEventListener('click', () => {
    menuOverlay.classList.add('active');
});

// Close menu on 'X' button click
closeBtn.addEventListener('click', () => {
    menuOverlay.classList.remove('active');
});

window.addEventListener('click', (event) => {
    if (menuOverlay.classList.contains('active') && !menuOverlay.contains(event.target) && !hamburger.contains(event.target)) {
        menuOverlay.classList.remove('active'); // Remove active class if clicked outside
    }
});

hamburger.addEventListener('click', (event) => {
    if (menuOverlay.classList.contains('active') && !menuOverlay.contains(event.target) && !hamburger.contains(event.target)) {
        menuOverlay.classList.remove('active'); // Remove active class if clicked outside
    }
});



//counter
const counters = document.querySelectorAll('.counter');

        counters.forEach(counter => {
        counter.innerText = '0'; // Set initial value to 0
        
        const updateCounter = () => {
            const target = +counter.getAttribute('data-target'); // Get target value
            const current = +counter.innerText;

            // Define speed, adjust based on desired speed
            const increment = target / 150; 

            if (current < target) {
            counter.innerText = `${Math.ceil(current + increment)}`;
            setTimeout(updateCounter, 30); // Adjust time for smoothness
            } else {
            counter.innerText = target; // Ensure final value is accurate
            }
        };

        updateCounter();
        });




