import headerMenu from './header-menu';

const Account = () => {

  let init = () => {
    headerMenu.init();
  }

  return {
    init
  }

}

export default new Account();
