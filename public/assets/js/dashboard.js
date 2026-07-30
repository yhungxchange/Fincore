document.addEventListener("DOMContentLoaded", function () {

    const menuButton = document.querySelector(".menu-btn");
    const sidebar = document.querySelector(".sidebar");

    if (menuButton && sidebar) {

        menuButton.addEventListener("click", function () {
            sidebar.classList.toggle("active");
        });

    }

});
