const postStock = (id, is_sold) => {
  console.log(id);
  const params = new URLSearchParams();
  params.append('menu_id', id);
  params.append('is_sold', is_sold);
  axios.post('/team5/api/daily/set-stock.php', params)
  .then(response => {
    console.log(response);
    const state = response.is_sold ? 'sold' : 'non-sold';
    const els = document.getElementById(id)
        .querySelectorAll('.sold, .non-sold');
    console.log(els);
    els.forEach(el => {
      el.classList.remove('sold');
      el.classList.remove('non-sold');
      el.classList.add(state);
    });
  });
};
