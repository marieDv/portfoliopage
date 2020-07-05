let lastLink = document.getElementById("select-all");

window.addEventListener('load', function () {
  filterContent();
  scrollReveal();
  detectIfItemIshovered();
})

function detectIfItemIshovered() {
  var items = document.getElementsByClassName("item-text");
  for (let i = 0; i < items.length; i++) {
   

    items[i].addEventListener('mousemove', function (event) {
      // if (!items[i].parentNode.classList.contains("hide-item")) {
        // console.log(items[i].parentNode);
        let bb = items[i].getBoundingClientRect();
        var x = event.clientX - bb.left;
        var y = event.clientY - bb.top;

        items[i].querySelector('h3').style.transform = "translateX(" + (x - (items[i].offsetWidth / 2)) + "px) translateY(" + (y - (items[i].offsetHeight / 2)) + "px)";
      // }
    });
    items[i].addEventListener('mouseleave', function () {
      console.log("mouseleave")
      items[i].querySelector('h3').style.color = "white";
    });
  }
}

function scrollReveal() {
  // TweenLite.set(document.querySelector("#main"), {
  //   y: -window.pageYOffset
  // })

  var controller = new ScrollMagic.Controller();
  var revealElements = document.getElementsByClassName("item");
  for (var i = 0; i < revealElements.length; i++) { // create a scene for each element
    new ScrollMagic.Scene({
      triggerElement: revealElements[i], // y value not modified, so we can use element as trigger as well
      offset: 50,												 // start a little later
      triggerHook: 0.9,
      reverse: false // only do once
    })
      .setClassToggle(revealElements[i], "visible") // add class toggle
      // .addIndicators({ name: "digit " + (i + 1) }) // add indicators (requires plugin)
      .addTo(controller);
  }
}
function filterContent() {
  let webCommercial = document.getElementById("select-web-commercial");
  let webNonCommercial = document.getElementById("select-web-non-commercial");
  let creativeCoding = document.getElementById("select-creative-coding");
  let all = document.getElementById("select-all");
  let items = document.getElementsByClassName("item");
  webCommercial.addEventListener("click", function () {
    filter(event.target, items, "web-commercial");
  });
  webNonCommercial.addEventListener("click", function () {
    filter(event.target, items, "web-non-commercial");
  });
  creativeCoding.addEventListener("click", function () {
    filter(event.target, items, "creative-coding");
  });
  all.addEventListener("click", function () {
    filter(event.target, items, "all");
  });
}




//HELPER FUNCTIONS
function filter(link, items, string) {
  if (string !== "all") {
    for (let i = 0; i < items.length; i++) {
      items[i].style.opacity = 1;
      items[i].style.pointerEvents = "all";
    }
    for (let i = 0; i < items.length; i++) {
      if (items[i].classList.contains(string)) {
        items[i].style.order = 1;
        items[i].style.pointerEvents = "all";
      } else {
        items[i].style.order = 2;
        items[i].style.opacity = 0.15;
        items[i].style.pointerEvents = "none";
      }
    }
  } else {
    for (let i = 0; i < items.length; i++) {
      items[i].style.opacity = 1;
      items[i].style.order = 1;
      items[i].style.pointerEvents = "all";
    }
  }
  link.classList.add("filter-selected");
  lastLink.classList.remove("filter-selected");
  lastLink = link;
}