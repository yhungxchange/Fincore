// =========================
// Mobile Sidebar Toggle
// =========================

const menuBtn = document.getElementById("menuToggle");
const sidebar = document.getElementById("sidebar");

if (menuBtn && sidebar) {

    menuBtn.addEventListener("click", () => {

        sidebar.classList.toggle("show");

    });

}

// =========================
// Hide / Show Balance
// =========================

const balance = document.getElementById("walletBalance");
const eye = document.getElementById("toggleBalance");

if (balance && eye) {

    const originalBalance = balance.textContent;

    let hidden = false;

    eye.addEventListener("click", () => {

        if (hidden) {

            balance.textContent = originalBalance;

            eye.classList.remove("fa-eye-slash");
            eye.classList.add("fa-eye");

        } else {

            balance.textContent = "********";

            eye.classList.remove("fa-eye");
            eye.classList.add("fa-eye-slash");

        }

        hidden = !hidden;

    });

}

// =========================
// Dynamic Greeting
// =========================

const greeting = document.getElementById("greeting");

if (greeting) {

    const hour = new Date().getHours();

    let message = "Good Evening";

    if (hour >= 5 && hour < 12) {

        message = "Good Morning";

    } else if (hour >= 12 && hour < 17) {

        message = "Good Afternoon";

    }

    greeting.innerHTML = `${message}, ${greeting.innerHTML.split(",")[1]}`;

}
