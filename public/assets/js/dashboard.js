document.addEventListener("DOMContentLoaded", () => {

    const menuBtn = document.getElementById("menuBtn");
    const sidebar = document.getElementById("sidebar");

    if(menuBtn){

        menuBtn.addEventListener("click", () => {

            sidebar.classList.toggle("active");

        });

    }

    document.addEventListener("click", (e)=>{

        if(window.innerWidth <= 768){

            if(
                !sidebar.contains(e.target) &&
                !menuBtn.contains(e.target)
            ){

                sidebar.classList.remove("active");

            }

        }

    });

});
