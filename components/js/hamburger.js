document.addEventListener('DOMContentLoaded', function () {
  const hamburger = document.querySelector('.hamburger');
  const sidebar = document.querySelector('.sidebar');
  const overlay = document.querySelector('.overlay');
  const navLinks = document.querySelectorAll('.sidebar a');

  if (!hamburger || !sidebar || !overlay) return;

  hamburger.addEventListener('click', () => {
    sidebar.classList.add('active');
    overlay.classList.add('active');
    hamburger.classList.add('hidden');
  });

  const closeSidebar = () => {
    sidebar.classList.remove('active');
    overlay.classList.remove('active');
    hamburger.classList.remove('hidden');
  };

  overlay.addEventListener('click', closeSidebar);
  navLinks.forEach(link => link.addEventListener('click', closeSidebar));
});