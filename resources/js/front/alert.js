const alertBox = document.querySelectorAll('.alert-box');

if (alertBox) {
    alertBox.forEach(box => {
        box.addEventListener('click', () => hideAlertBox(box));

        setTimeout(() => {
            console.log('e')
            hideAlertBox(box);
        }, 4500);
    });
}

function hideAlertBox(box) {
    box.classList.add('opacity-0');

    setTimeout(() => box.remove(), 1500);
}