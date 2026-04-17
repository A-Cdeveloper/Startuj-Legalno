var $ = jQuery.noConflict();

/**
 * Sekcije u #main-content: fade-in + blagi pomeraj nadole pri ulasku u viewport.
 * Sekcije koje su već vidljive pri učitavanju dobijaju .is-visible odmah.
 */
(function () {
  "use strict";

  function reveal(el) {
    el.classList.add("is-visible");
  }

  function initRevealOnScroll() {
    var sections = document.querySelectorAll(
      "#main-content section.reveal-on-scroll",
    );
    if (!sections.length) {
      return;
    }

    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
      sections.forEach(function (sec) {
        reveal(sec);
      });
      return;
    }

    if (!("IntersectionObserver" in window)) {
      sections.forEach(function (sec) {
        reveal(sec);
      });
      return;
    }

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            reveal(entry.target);
            observer.unobserve(entry.target);
          }
        });
      },
      {
        root: null,
        rootMargin: "0px 0px -10% 0px",
        threshold: 0.06,
      },
    );

    var vh = window.innerHeight || document.documentElement.clientHeight;

    sections.forEach(function (sec) {
      var rect = sec.getBoundingClientRect();
      var inView = rect.top < vh && rect.bottom > 0;
      if (inView) {
        reveal(sec);
      } else {
        observer.observe(sec);
      }
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initRevealOnScroll);
  } else {
    initRevealOnScroll();
  }
})();
