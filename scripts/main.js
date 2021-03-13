// set focus to buttons
const setFocusToButtons = () => {
  const urlPath = window.location.pathname;

  switch (true) {
    case urlPath.includes('index'):
      element = document
        .getElementById('homeButton')
        .classList.add('primaryButtonFocus');
      break;
    case urlPath.includes('book'):
      document.getElementById('bookButton').classList.add('primaryButtonFocus');
      break;
    case urlPath.includes('royso'):
      document
        .getElementById('roysoButton')
        .classList.add('primaryButtonFocus');
      break;
    case urlPath.includes('shop'):
      document.getElementById('shopButton').classList.add('primaryButtonFocus');
      break;
    default:
      document.getElementById('homeButton').classList.add('primaryButtonFocus');
      break;
  }
};
setFocusToButtons();

// open/close contact form
document
  .getElementById('contactButton')
  .addEventListener('click', () =>
    document.getElementById('contactForm').classList.add('contactVisible')
  );
if (document.getElementsByClassName('contactErrorMsg').length > 0) {
  document.getElementById('contactForm').classList.add('contactVisible');
}
document
  .getElementById('closeContactForm')
  .addEventListener('click', () =>
    document.getElementById('contactForm').classList.remove('contactVisible')
  );

// navbar
handleNavbar = () => {
  let links = document.getElementById('links');
  let icon = document.getElementById('mobileMenuIcon');
  if (links.style.display === 'none' || links.style.display === '') {
    links.style.display = 'flex';
    icon.textContent = 'close'
  } else {
    links.style.display = 'none';
    icon.textContent = 'menu'
  }
};
