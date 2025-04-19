const authIcons = document.querySelectorAll(".auth-icon");

authIcons.forEach((e) => {
    e.addEventListener('click', () => {
        const isInvisible = e.src.includes('visibility_off');
        const id = e.getAttribute('data-id');
        const input = document.querySelector(`#${id} .input-hidden`);

        if (isInvisible) {
            input.type = 'text';
            e.src = IMAGE_PATH + "visibility.svg";
        } else {
            input.type = 'password';
            e.src = IMAGE_PATH + "visibility_off.svg";
        }
    });
});
