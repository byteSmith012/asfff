//=============== Перевірка на підтримку браузером WEBP =======
function testWebP(callback) {
  var webP = new Image();
  webP.onload = webP.onerror = function () {
    callback(webP.height == 2);
  };
  webP.src = "data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA";
}

testWebP(function (support) {
  if (support == true) {
    document.querySelector("body").classList.add("webp");
  } else {
    document.querySelector("body").classList.add("no-webp");
  }
});
//=============================================================
var lazyLoadInstance = new LazyLoad({
  // Your custom settings go here
});

(function (d, w, s) {
  var widgetHash = "pfb1fyfyp2w3hao4eg1n",
    gcw = d.createElement(s);
  gcw.type = "text/javascript";
  gcw.async = true;
  gcw.src = "//widgets.binotel.com/getcall/widgets/" + widgetHash + ".js";
  var sn = d.getElementsByTagName(s)[0];
  sn.parentNode.insertBefore(gcw, sn);
})(document, window, "script");

$("#comm_slider").slick({
  dots: false,
  infinite: true,
  speed: 300,
  autoplay: true,
  autoplaySpeed: 3000,
  slidesToShow: 1,
  centerMode: true,
  slidesToScroll: 1,
  centerPadding: "200px",
  prevArrow: '<button type = "button" class = "slick_prev"><i class="fas fa-chevron-left"></i></ button>',
  nextArrow: '<button type = "button" class = "slick_next"><i class="fas fa-chevron-right"></i></ button>',
  appendArrows: $(".slide_comment"),
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        centerPadding: "10px",
      },
    },
    {
      breakpoint: 992,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerPadding: "10px",
        swipe: true,
      },
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        centerPadding: "0px",
        swipe: true,
      },
    },
  ],
});

const navbar = document.querySelector(".navbar");

window.addEventListener("scroll", () => {
  if (window.scrollY > 0) {
    navbar.classList.add("navbar__scroll");
  } else {
    navbar.classList.remove("navbar__scroll");
  }
});
