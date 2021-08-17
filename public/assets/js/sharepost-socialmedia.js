/*==============================================================*/
    //Sharing Social Media -START CODE-
    /*==============================================================*/

/* 
WhatsApp
https://api.whatsapp.com/send?text=[post-title] [post-url]

Facebook
https://www.facebook.com/sharer.php?u=[post-url]

Twitter
https://twitter.com/share?url=[post-url]&text=[post-title]


Pinterest
https://pinterest.com/pin/create/bookmarklet/?media=[post-img]&url=[post-url]&is_video=[is_video]&description=[post-title]


LinkedIn
https://www.linkedin.com/shareArticle?url=[post-url]&title=[post-title]


*/

const facebookBtn = document.querySelector(".facebook");
const twitterBtn = document.querySelector(".twitter");
const whatsappBtn = document.querySelector(".whatsapp");
const pinterestBtn = document.querySelector(".pinterest");
const linkedinBtn = document.querySelector(".linkedin");

function init(){
    const pinterestImg = document.querySelector(".pinterest-img");

    let postUrl = encodeURI(document.location.href);
    let postTitle = encodeURI("Hi everyone, please check this out !!");
    let postImg = encodeURI(pinterestImg.src);

    facebookBtn.setAttribute("href", `https://www.facebook.com/sharer.php?u=${postUrl}`);

    twitterBtn.setAttribute("href", `https://twitter.com/share?url=${postUrl}&text=${postTitle}`);

    whatsappBtn.setAttribute("href", `https://api.whatsapp.com/send?text=${postTitle} ${postUrl}`);

    pinterestBtn.setAttribute("href", `https://pinterest.com/pin/create/bookmarklet/?media=${postImg}&url=${postUrl}&description=${postTitle}`);

    linkedinBtn.setAttribute("href", `https://www.linkedin.com/shareArticle?url=${postUrl}&title=${postTitle}`);

}

init();