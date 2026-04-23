let templateFile = await fetch("./component/Movie/template.html");
let template = await templateFile.text();

let Movie = {};

Movie.format = function (movie) {
  let html = template;
  html = html.replaceAll("{{name}}", movie.name);
  html = html.replaceAll("{{image}}", movie.image);
  html = html.replaceAll("{{year}}", movie.year || "");
  return html;
};

export { Movie };