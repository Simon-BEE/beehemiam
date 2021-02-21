// Modal click open
try {
    document.querySelectorAll('.modal-button').forEach(button => {
        button.addEventListener('click', () => {
            toggleModal(document.querySelector('.modal-content'));
            toggleOverlay(true);
        });
    });
} catch (error) {
    console.error(error, "Cannot load JS correctly");
}

try {
    document.querySelectorAll('.modal-close').forEach(button => {
        button.addEventListener('click', () => {
            toggleModal(document.querySelector('.modal-content:not(.opacity-0)'));
            toggleOverlay();
        });
    });
} catch (error) {
    console.error(error, "Cannot load JS correctly");
}

// Popover user avatar click
try {
    document.querySelectorAll('.popover-button').forEach(button => {
        button.addEventListener('click', (e) => {
            togglePopover(e.currentTarget.parentNode.querySelector('.popover-menu'));
            toggleOverlay();
        });
    });
} catch (error) {
    console.error(error, "Cannot load JS correctly");
}

// Overlay click to close popover or modal
try {
    document.querySelector('.clickable-overlay').addEventListener('click', () => {
        document.querySelectorAll('.popover-menu:not(.opacity-0)').forEach(menu => {
            togglePopover(menu);
        });
        document.querySelectorAll('.modal-content:not(.opacity-0)').forEach(modal => {
            toggleModal(modal);
        });
        toggleOverlay();
    });
} catch (error) {
    console.error(error, "Cannot load JS correctly");
}

function toggleModal(modal) {
    modal.classList.toggle('opacity-0');
    modal.classList.toggle('-z-1');
    modal.classList.toggle('z-40');
}

function toggleOverlay(modal = false) {
    const overlay = document.querySelector('.clickable-overlay');

    overlay.classList.toggle('hidden');
    overlay.classList.toggle('z-20');
    if (modal) {
        overlay.classList.add('bg-black', 'bg-opacity-25');
    }else{
        overlay.classList.remove('bg-black', 'bg-opacity-25');
    }
}

function togglePopover(popover) {
    popover.classList.toggle('md:opacity-0');
    popover.classList.toggle('-z-1');
    popover.classList.toggle('z-30');
}