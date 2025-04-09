import Isotope from 'isotope-layout';

document.addEventListener('DOMContentLoaded', () => {
  const grid = document.querySelector('.table_product');
  if (!grid) return;

  const iso = new Isotope(grid, {
    itemSelector: '.card_product',
    layoutMode: 'fitRows',
  });

  const buttons = document.querySelectorAll('.subItem');

  buttons.forEach((btn) => {
    btn.addEventListener('click', () => {
      buttons.forEach((b) => b.classList.remove('active'));
      btn.classList.add('active');

      const filterValue = btn.getAttribute('data-filter');
      iso.arrange({ filter: filterValue });
    });
  });
});
