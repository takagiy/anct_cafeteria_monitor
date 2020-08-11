const setState = (id, is_sold) => {
  const state = is_sold ? 'sold' : 'non-sold';
  const els = document.getElementById(id)
      .querySelectorAll('.sold, .non-sold');
  els.forEach(el => {
    el.classList.remove('sold');
    el.classList.remove('non-sold');
    el.classList.add(state);
  });
};

const isSold = (id) => {
  const el = document.getElementById(id)
      .querySelector('.sold, .non-sold');
  return el.classList.contains('sold');
};

const postStock = (id) => {
  console.log(id);
  const params = new URLSearchParams();
  params.append('menu_id', id);
  params.append('is_sold', !isSold(id));
  axios.post('/team5/api/daily/set-stock.php', params)
    .then(response => {
      console.log(response);
      setState(id, response.data.is_sold);
    });
};
