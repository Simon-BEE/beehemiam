require('./bootstrap');

require('./front/alert');
require('./front/modal');


// Responsive menu click
try {
    document.querySelector('.responsive-button').addEventListener('click', () => {
        document.querySelector('.responsive-menu').classList.toggle('hidden')
    });
} catch (error) {
    console.error(error, "Cannot load JS correctly");
}
