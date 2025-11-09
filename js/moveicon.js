 const links = document.querySelectorAll('.nav-link');

  links.forEach(link => {
    const icon = link.querySelector('lord-icon'); 

    if (icon) {
      link.addEventListener('mouseenter', () => {
        icon.dispatchEvent(new Event('mouseenter'));
      });
      link.addEventListener('mouseleave', () => {
        icon.dispatchEvent(new Event('mouseleave'));
      });
    }
  });