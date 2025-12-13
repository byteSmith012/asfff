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
  prevArrow:
    '<button type = "button" class = "slick_prev"><svg width="800px" height="800px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 10L8 14L6 14L-2.62268e-07 8L6 2L8 2L8 6L16 6L16 10L8 10Z" fill="#000000"/></svg></ button>',
  nextArrow: '<button type = "button" class = "slick_next"></ button>',
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
