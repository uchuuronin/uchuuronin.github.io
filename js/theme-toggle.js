(function () {
  var btn = document.getElementById('themeToggle');

  // Always start in DARK on every load/refresh
  document.body.classList.remove('theme-light');
  document.body.classList.add('theme-dark');
  if (btn) btn.textContent = 'Light'; // "switch to light"

  // Ignore any old saved preference (and stop persisting)
  try { localStorage.removeItem('cv-theme'); } catch (e) {}

  // Toggle only for this page view (no saving)
  if (btn) {
    btn.addEventListener('click', function () {
      var isDark = document.body.classList.toggle('theme-dark'); // flips dark
      document.body.classList.toggle('theme-light', !isDark);
      btn.textContent = isDark ? 'Light' : 'Dark';
    });
  }
})();
