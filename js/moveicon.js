const link = document.querySelector('.nav-link');
  const icon = document.querySelector('#iconHome');

  // dispara animação quando o mouse entra no link
  link.addEventListener('mouseenter', () => {
    icon.dispatchEvent(new Event('mouseenter'));
  });

  // para animação quando o mouse sai
  link.addEventListener('mouseleave', () => {
    icon.dispatchEvent(new Event('mouseleave'));
  });