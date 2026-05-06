let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function (hAbout, hHome, hProfile, profile) {
  let html = template;
  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{hHome}}", hHome);
  html = html.replace("{{hProfile}}", hProfile);

  let profileDisplay;
  if (profile) {
    let avatar;
    if (profile.image) {
      avatar = `<img class="navbar__profile-avatar navbar__profile-avatar--img" src="../server/images/${profile.image}" alt="${profile.nom}">`;
    } else {
      avatar = `<div class="navbar__profile-avatar navbar__profile-avatar--letter">${profile.nom.charAt(0).toUpperCase()}</div>`;
    }
    profileDisplay = `${avatar}<span class="navbar__profile-name">${profile.nom}</span>`;
  } else {
    profileDisplay = `<span>Profil</span>`;
  }

  html = html.replace("{{profileDisplay}}", profileDisplay);
  return html;
};

export { NavBar };
