// import tether from 'tether';

const HeaderMenu = () => {

  let init = () => {
    let target = document.getElementById('account-menu');
    if (!target) return;
    let dropInstance = new Drop({
      target,
      content: document.querySelector('.account-menu'),
      classes: '',
      position: 'bottom right',
      openOn: 'click'
    })
    return dropInstance;
  }

  return {
    init
  }
}

export default new HeaderMenu();
