let templateFile = await fetch('./component/ProfileEditForm/template.html');
let template = await templateFile.text();

let ProfileEditForm = {};

ProfileEditForm.format = function(handler){
    let html = template;
    html = html.replace('{{handler}}', handler);
    return html;
}

ProfileEditForm.fill = function(id, nom, image, age){
    document.querySelector('.editProfile__form [name="id"]').value = id;
    document.querySelector('.editProfile__form [name="name"]').value = nom;
    document.querySelector('.editProfile__form [name="image"]').value = image || '';
    document.querySelector('.editProfile__form [name="age"]').value = age;
}

export {ProfileEditForm};
