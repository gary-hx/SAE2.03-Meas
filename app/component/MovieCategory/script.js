import { Movie } from "../Movie/script.js";

let templateFile = await fetch(new URL("./template.html", import.meta.url));
let template = await templateFile.text();

let MovieCategory = {};
MovieCategory.template = template;

MovieCategory.format = function (groupedMovies, favoriteIds) {
  if (!groupedMovies || Object.keys(groupedMovies).length === 0) {
    return '<p>Aucun film disponible pour le moment.</p>';
  }

  let html = "";

  for (let categoryName in groupedMovies) {
    let films = groupedMovies[categoryName];
    let section = MovieCategory.template;
    section = section.replace("{{categoryName}}", categoryName);
    section = section.replaceAll(
      "{{movies}}",
      Movie.formatMany(films),
    );
    html += section;
  }

  return html;
};

export { MovieCategory };