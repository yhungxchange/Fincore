// ===========================
// FINCORE DASHBOARD V2
// ===========================

// Sidebar Toggle
const menuBtn = document.getElementById("menuBtn");
const sidebar = document.getElementById("sidebar");

if (menuBtn && sidebar) {

    menuBtn.addEventListener("click", () => {

        sidebar.classList.toggle("show");

    });

    // Close sidebar when clicking outside (mobile)
    document.addEventListener("click", (e) => {

        if (
            window.innerWidth <= 992 &&
            !sidebar.contains(e.target) &&
            !menuBtn.contains(e.target)
        ) {
            sidebar.classList.remove("show");
        }

    });

}

// ===========================
// Hide / Show Wallet Balance
// ===========================

const balance = document.getElementById("walletBalance");
const eye = document.getElementById("toggleBalance");

if (balance && eye) {

    const realBalance = balance.innerHTML;

    let hidden = false;

    eye.addEventListener("click", () => {

        if (!hidden) {

            balance.innerHTML = "₦********";

            eye.classList.remove("fa-eye");

            eye.classList.add("fa-eye-slash");

        } else {

            balance.innerHTML = realBalance;

            eye.classList.remove("fa-eye-slash");

            eye.classList.add("fa-eye");

        }

        hidden = !hidden;

    });

}

// ===========================
// Dynamic Greeting
// ===========================

const greeting = document.getElementById("greeting");

if (greeting) {

    const hour = new Date().getHours();

    let text = "Good Evening";

    if (hour >= 5 && hour < 12) {

        text = "Good Morning";

    } else if (hour >= 12 && hour < 17) {

        text = "Good Afternoon";

    }

    const username = greeting.innerText.split(",")[1];

    greeting.innerHTML = `${text}, ${username}`;

}

// ===========================
// Active Menu Highlight
// ===========================

const links = document.querySelectorAll(".menu a");

links.forEach(link => {

    link.addEventListener("click", () => {

        links.forEach(item => item.classList.remove("active"));

        link.classList.add("active");

    });

});

// ===========================
// Simple Fade Animation
// ===========================

window.addEventListener("load", () => {

    document.body.style.opacity = "1";

});
