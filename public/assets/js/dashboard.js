// ===============================
// FINCORE DASHBOARD V3
// ===============================

// Sidebar Toggle
const menuBtn = document.getElementById("menuBtn");
const sidebar = document.getElementById("sidebar");

if (menuBtn && sidebar) {

    menuBtn.addEventListener("click", function () {

        sidebar.classList.toggle("show");

    });

}

// ===============================
// Hide / Show Wallet Balance
// ===============================

const balance = document.getElementById("walletBalance");
const toggleBalance = document.getElementById("toggleBalance");

if (balance && toggleBalance) {

    const originalBalance = balance.innerHTML;

    let hidden = false;

    toggleBalance.addEventListener("click", function () {

        if (!hidden) {

            balance.innerHTML = "₦********";

            toggleBalance.innerHTML =
                '<i class="fa-solid fa-eye-slash"></i>';

        } else {

            balance.innerHTML = originalBalance;

            toggleBalance.innerHTML =
                '<i class="fa-solid fa-eye"></i>';

        }

        hidden = !hidden;

    });

}

// ===============================
// Dynamic Greeting
// ===============================

const greeting = document.getElementById("greeting");

if (greeting) {

    const hour = new Date().getHours();

    let text = "Good Evening";

    if (hour >= 5 && hour < 12) {

        text = "Good Morning";

    } else if (hour >= 12 && hour < 17) {

        text = "Good Afternoon";

    }

    const username = greeting.innerHTML.split(",")[1];

    greeting.innerHTML = text + "," + username;

}

// ===============================
// Active Sidebar Link
// ===============================

const menuLinks = document.querySelectorAll(".sidebar-menu a");

menuLinks.forEach(link => {

    link.addEventListener("click", function () {

        menuLinks.forEach(item => {

            item.classList.remove("active");

        });

        this.classList.add("active");

    });

});

// ===============================
// Close Sidebar On Mobile
// ===============================

document.addEventListener("click", function (e) {

    if (

        window.innerWidth <= 992 &&

        sidebar &&

        sidebar.classList.contains("show") &&

        !sidebar.contains(e.target) &&

        !menuBtn.contains(e.target)

    ) {

        sidebar.classList.remove("show");

    }

});
