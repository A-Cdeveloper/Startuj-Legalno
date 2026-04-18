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

/**
 * Glavni meni: .active na linku dok si u sekciji čiji id odgovara hash-u u href-u.
 * Isti origin + cilj sa id postoji unutar #main-content (bez stroge jednakosti pathname-a —
 * WP meni često ima drugačiji path od window.location, npr. root URL vs podfolder).
 */
(function () {
  "use strict";

  function initNavScrollSpy() {
    var nav = document.querySelector(".site-nav");
    if (!nav) {
      return;
    }

    var links = nav.querySelectorAll("a[href*='#']");
    if (!links.length) {
      return;
    }

    var main = document.getElementById("main-content");
    if (!main) {
      return;
    }

    var idToLinks = {};

    Array.prototype.forEach.call(links, function (link) {
      var href = link.getAttribute("href");
      if (!href) {
        return;
      }
      var u;
      try {
        u = new URL(href, window.location.href);
      } catch (e) {
        return;
      }
      if (
        u.hostname !== window.location.hostname ||
        u.port !== window.location.port
      ) {
        return;
      }
      if (!u.hash || u.hash === "#") {
        return;
      }
      var id = decodeURIComponent(u.hash.slice(1));
      if (!id) {
        return;
      }
      var el = document.getElementById(id);
      if (!el || !main.contains(el)) {
        return;
      }
      if (!idToLinks[id]) {
        idToLinks[id] = [];
      }
      idToLinks[id].push(link);
    });

    var sectionIds = Object.keys(idToLinks);
    if (!sectionIds.length) {
      return;
    }

    var sections = sectionIds
      .map(function (sid) {
        return document.getElementById(sid);
      })
      .filter(Boolean)
      .sort(function (a, b) {
        return a.compareDocumentPosition(b) & Node.DOCUMENT_POSITION_FOLLOWING
          ? -1
          : 1;
      });

    if (!sections.length) {
      return;
    }

    var managed = [];
    Object.keys(idToLinks).forEach(function (sid) {
      idToLinks[sid].forEach(function (l) {
        if (managed.indexOf(l) === -1) {
          managed.push(l);
        }
      });
    });

    function headerOffset() {
      var h = document.querySelector(".site-header");
      return h ? Math.ceil(h.getBoundingClientRect().height) + 10 : 80;
    }

    function updateActive() {
      var offset = headerOffset();
      var line = window.scrollY + offset;
      var activeId = "";
      for (var i = 0; i < sections.length; i++) {
        var sec = sections[i];
        if (!sec || !sec.id) {
          continue;
        }
        var top = sec.getBoundingClientRect().top + window.scrollY;
        if (top <= line) {
          activeId = sec.id;
        }
      }

      // Poslednja sekcija (npr. #work): ako je kratka, vrh možda nikad ne pređe "liniju" ispod headera.
      // Samo blizu samog dna stranice forsiraj poslednju — inače viewBottom>=lastTop prebacuje na #work
      // dok si još u #usluga (donji deo ekrana samo "dodirne" početak sledeće sekcije).
      var lastSec = sections[sections.length - 1];
      if (lastSec && lastSec.id) {
        var doc = document.documentElement;
        var maxScroll = Math.max(0, doc.scrollHeight - window.innerHeight);
        var nearBottom = window.scrollY >= maxScroll - 4;
        if (nearBottom && activeId !== lastSec.id) {
          activeId = lastSec.id;
        }
      }

      for (var j = 0; j < managed.length; j++) {
        managed[j].classList.remove("active");
      }
      if (activeId && idToLinks[activeId]) {
        idToLinks[activeId].forEach(function (link) {
          link.classList.add("active");
        });
      }
    }

    var ticking = false;
    function onScroll() {
      if (!ticking) {
        ticking = true;
        window.requestAnimationFrame(function () {
          ticking = false;
          updateActive();
        });
      }
    }

    window.addEventListener("scroll", onScroll, { passive: true });
    window.addEventListener("resize", onScroll);
    window.addEventListener("hashchange", updateActive);
    updateActive();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initNavScrollSpy);
  } else {
    initNavScrollSpy();
  }
})();
