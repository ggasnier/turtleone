/**!
 Navigation Button Toggle class
 */
(function () {
  // old browser or not ?
  if (!("querySelector" in document && "addEventListener" in window)) {
    return;
  }
  window.document.documentElement.className += " js-enabled";

  function menuToggle() {
    var menuButton = document.querySelector(".header-menu-hamburger");
    var closeButton = document.querySelector(".toggle-close-menu");
    var menuModal = document.querySelector(".header-menu-items");

    if (menuButton) {
      menuButton.addEventListener(
        "click",
        function (e) {
          menuButton.classList.toggle("active");
          menuModal.classList.toggle("show-modal");
        },
        false
      );
    }

    if (closeButton) {
      closeButton.addEventListener(
        "click",
        function (e) {
          menuButton.classList.toggle("active");
          menuModal.classList.toggle("show-modal");
        },
        false
      );
    }
  }

  function subMenuToggle() {
    var menuItemHasChildren = document.querySelectorAll(
      ".menu-item-has-children"
    );

    menuItemHasChildren.forEach(function (element) {
      var menuButton = element.querySelector(".sub-menu-toggle");
      var subMenu = menuButton.closest(".menu-item").querySelector(".sub-menu");
      if (menuButton) {
        menuButton.addEventListener(
          "click",
          function (e) {
            menuButton.classList.toggle("active");
            subMenu.classList.toggle("show-modal");
          },
          false
        );
      }
    });
  }

  function searchToggle() {
    var searchButton = document.querySelector(".toggle-search");
    var closeButton = document.querySelector(".toggle-close-search");
    var searchModal = document.querySelector(".search-modal");

    if (searchButton) {
      searchButton.addEventListener(
        "click",
        function (e) {
          searchButton.classList.toggle("active");
          searchModal.classList.toggle("show-modal");
        },
        false
      );
    }

    if (closeButton) {
      closeButton.addEventListener(
        "click",
        function (e) {
          searchButton.classList.toggle("active");
          searchModal.classList.toggle("show-modal");
        },
        false
      );
    }
  }

  menuToggle();
  subMenuToggle();
  searchToggle();
})();
