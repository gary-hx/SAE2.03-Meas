import { Profile } from "../Movie/script.js";

let templateFile = await fetch(new URL("./template.html", import.meta.url));
let template = await templateFile.text();

let ProfileCategory = {};
ProfileCategory.template = template;

ProfileCategory.format = function (groupedProfiles, favoriteIds) {
  if (!groupedProfiles || Object.keys(groupedProfiles).length === 0) {
    return "<p>Aucun profil disponible pour le moment.</p>";
  }

  let html = "";

  for (let categoryName in groupedProfiles) {
    let profiles = groupedProfiles[categoryName];
    let section = ProfileCategory.template;
    section = section.replace("{{categoryName}}", categoryName);
    section = section.replaceAll(
      "{{profiles}}",
      Profile.formatMany(profiles, favoriteIds),
    );
    html += section;
  }

  return html;
};

export { ProfileCategory };
