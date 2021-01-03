// set focus to buttons
const setFocusToButtons = () => {
  const urlPath = window.location.pathname;
  console.log(urlPath);

  switch (true) {
    case urlPath.includes('index'):
      document.getElementById('homeButton').focus();
      break;
    case urlPath.includes('book'):
      document.getElementById('bookButton').focus();
      break;
    case urlPath.includes('royso'):
      document.getElementById('roysoButton').focus();
      break;
    case urlPath.includes('shop'):
      document.getElementById('shopButton').focus();
      break;
    default:
      document.getElementById('homeButton').focus();
      break;
  }
};

setFocusToButtons();
