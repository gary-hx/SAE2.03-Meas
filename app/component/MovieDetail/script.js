let templateFile = await fetch("./component/MovieDetail/template.html");
let template = await templateFile.text();

let MovieDetail = {};
const IMAGE_FOLDER = "../server/images/";

MovieDetail.format = function (movie) {
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
  html = html.replaceAll("{{category}}", movie.category);
  return html;
};

export { MovieDetail };