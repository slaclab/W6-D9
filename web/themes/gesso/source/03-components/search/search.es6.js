import Drupal from 'drupal';

Drupal.behaviors.search = {
  attach(context) {
    const search = context.querySelectorAll('.c-search__form');
    search.forEach(searchForm => {
      const searchInput = searchForm.querySelector('.c-search__input');
      const searchRadios = searchForm.querySelectorAll(
        'input[name="search_type"]'
      );
      const searchHidden = searchForm.querySelector('.c-search__hidden');
      function handleRadioChange() {
        const selectedSearch = this.value;
        let searchUrl = '/search';
        let searchInputName = 'keywords';
        searchHidden.innerHTML = '';
        if (selectedSearch === 'people') {
          searchUrl =
            'https://www-public.slac.stanford.edu/phonebook/dirsearch.aspx';
          searchInputName = 'NAME';
          searchHidden.insertAdjacentHTML(
            'beforeend',
            `<input type="hidden" name="lf" value="1" /><input type="hidden" name="url" value="" /><input type="hidden" name="gone" value="active" />`
          );
        }
        searchInput.setAttribute('name', searchInputName);
        searchForm.setAttribute('action', searchUrl);
      }
      if (searchRadios.length) {
        searchRadios.forEach(radio => {
          radio.addEventListener('change', handleRadioChange);
        });
        searchRadios[0].dispatchEvent(new InputEvent('change'));
        searchRadios[0].checked = true;
      }
    });
  },
};
