let templateFile = await fetch("./component/MovieDetail/template.html");
let template = await templateFile.text();

let Movie = {};
const IMAGE_FOLDER = "../server/images/";

Movie.format = function (movie) {
  let html = template;
  let imagePath = movie.image ? `${IMAGE_FOLDER}${movie.image}` : "";
  html = html.replaceAll("{{name}}", movie.name);
  html = html.replaceAll("{{image}}", imagePath);
  html = html.replaceAll("{{description}}", movie.description);
  html = html.replaceAll("{{year}}", movie.year);
  html = html.replaceAll("{{length}}", movie.length);
  html = html.replaceAll("{{min_age}}", movie.min_age);
  html = html.replaceAll("{{trailer}}", movie.trailer);
  html = html.replaceAll("{{director}}", movie.director);
  html = html.replaceAll("{{id_category}}", movie.id_category);
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