const types = ["Normal", "Fire", "Fighting", "Water", "Flying", "Grass", "Poison", "Eletric", "Ground", "Psychic", "Rock", "Ice", "Bug", "Dragon", "Ghost", "Dark", "Steel", "Fairy", "Stellar"]
let backgroundLivePreview = document.getElementById('background-img-live-preview');
let inputBackgroundImg = document.getElementById('background-image')
function livepreview()
{
types.forEach(type =>
{
    console.log(inputBackgroundImg.getAttribute('value'));
    if(inputBackgroundImg.getAttribute('value') == type) 
        {
            backgroundLivePreview.setAttribute('src', "img/background-" + type + ".jpg");
            console.log(backgroundLivePreview.getAttribute('src'));
        }
        else
        {
            backgroundLivePreview.setAttribute('src', "img/trash.png"); 
        }

}
);

}
        
document.querySelector('#background-image').addEventListener("change", function(e) {
    const target = e.target.value;
    if (types.includes(target)) {
        backgroundLivePreview.setAttribute('src', "img/background-" + target + ".jpg");
        console.log(backgroundLivePreview.getAttribute('src'));
    } else {
        backgroundLivePreview.setAttribute('src', "img/trash.png");
    }
});