/**
 * Main site JavaScript.
 */
(function () {
  'use strict';

  var header = document.querySelector('.site-header');

  if (header) {
    var scrollThreshold = 80;

    function onScroll() {
      if (window.scrollY > scrollThreshold) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // Smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      var targetId = this.getAttribute('href');
      if (targetId === '#') return;

      var target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  // Menu page tab switching
  var tabs = document.querySelectorAll('.menu-tab');

  if (tabs.length) {
    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        var target = this.getAttribute('data-tab');

        tabs.forEach(function (t) { t.classList.remove('is-active'); });
        document.querySelectorAll('.menu-tab-content').forEach(function (c) {
          c.classList.remove('is-active');
        });

        this.classList.add('is-active');
        var panel = document.getElementById(target);
        if (panel) panel.classList.add('is-active');
      });
    });
  }
})();
