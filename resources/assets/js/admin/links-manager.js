
const LinksManager = () => {
  let urls_input = $('input[name=urls]')
  let form = $('form.links-manager')
  let urls_data = urls_input.val()
  let data = JSON.parse(urls_data || '{}')

  const createButton = () => {
    let a = '<a href="#"> <i class="fa fa-link"></i> enlace </a>';
    a = $(a);
    return a
  }

  const syncJson = (json_field, data) => {
    let json = JSON.stringify(data)
    urls_input.val(json)
  }

  const update = (key, value) => {
    data[key] = value;
  }

  const addUrlInput = (item) => {
    let img = $(item).find('img')
    let dataset = img.data()
    let input = $('<input type="url" placeholder="http://" />').css('width', '100%')
    let key = dataset.value;
    let value = data[key];
    input.val(value);

    input.on('change', e => {
      update( key , input.val() )
      syncJson(urls_input, data);
    })

    img.after(input)
  }

  form.find('.imageThumbnail').each( (i, item) => {
    addUrlInput(item)
  })

  form.on('DOMNodeRemoved', event => {
    let item = $(event.target)
    if (item.is('.imageThumbnail')) {
      let img = item.find('img');
      let key = img.data().value;
      if (key) {
        data[key] = undefined;
      }
      syncJson(urls_input, data);
    }
  })

  form.on('DOMNodeInserted', event => {
    let item = $(event.target);
    if (item.is('.imageThumbnail')) {
      addUrlInput(item);
    }
  })
}

$(document).ready(() => {
  new LinksManager();
});

export default LinksManager;
