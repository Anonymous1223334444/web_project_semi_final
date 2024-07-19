let btn_connect = document.getElementById('btn_connect');
let btn_create = document.getElementById('btn_create');
let cards = document.querySelectorAll(".card");

btn_connect.addEventListener('click', function() {
    window.location.href = "http://localhost/web_dev_3/pages/Login.php"; 
});

btn_create.addEventListener('click', function() {
    window.location.href = "http://localhost/web_dev_3/pages/Signup.php"; 
});


cards.forEach(card => {
    card.addEventListener("click", function(e) {
        window.location.href = "http://localhost/web_dev_3/pages/course_detail.php";
    })
});

// cards.forEach(card => {
//     card.addEventListener("click", function(e) {
//         window.location.href = card.dataset.lecture;
//     })
// });

// Make mobile navigation work
const btnNavEl = document.querySelector(".btn-mobile-nav");
const headerEl = document.querySelector(".header");

btnNavEl.addEventListener("click", function () {
  headerEl.classList.toggle("nav-open");
});

// Smooth scrolling animation

const allLinks = document.querySelectorAll("a:link");

allLinks.forEach(function (link) {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    const href = link.getAttribute("href");

    // Scroll back to top
    if (href === "#")
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });

    // Scroll to other links
    if (href !== "#" && href.startsWith("#")) {
      const sectionEl = document.querySelector(href);
      sectionEl.scrollIntoView({ behavior: "smooth" });
    }

    // Close mobile naviagtion
    if (link.classList.contains("main-nav-link"))
      headerEl.classList.toggle("nav-open");
  });
});


var icon_dark = document.querySelectorAll(".dark-mode");
icon_dark.forEach (
    function(el){
        el.onclick = function() {
            document.body.classList.toggle("dark-theme")
            document.body.classList.toggle("dark-theme-nav")
            if (document.body.classList.contains("dark-theme")) {
              el.src = "http://localhost/web_dev_3/public/img/sun.png";
            } else{
              el.src = "http://localhost/web_dev_3/public/img/moon.png";
            }
        }
    }
)
