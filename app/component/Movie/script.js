let templateFile = await fetch("./component/Movie/template.html");
let template = await templateFile.text();

let Movie = {};
const IMAGE_FOLDER = "../server/images/";

Movie.format = function (movie) {
  let html = template;
  let imagePath = movie.image ? `${IMAGE_FOLDER}${movie.image}` : "";
  html = html.replaceAll("{{name}}", movie.name);
  html = html.replaceAll("{{image}}", imagePath);
  html = html.replaceAll("{{id}}", movie.id);
  return html;
};

Movie.formatMany = function (movies) {
  if (!movies || movies.length === 0) {
    return '<p>Aucun film disponible pour le moment.</p>';
  }
  let cards = "";
  for (let i = 0; i < movies.length; i++) {
    cards += Movie.format(movies[i]);
  }
  return `<section class="movies">${cards}</section>`;
};

export { Movie };