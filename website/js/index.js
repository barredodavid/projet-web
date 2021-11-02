// bouton Read More / Read Less 
let readMoreBtn = document.querySelectorAll('.read-more-btn');
let boxes = document.querySelectorAll('.box');

for (i = 0; i < boxes.length; i++)
{
        for (i=0; i<readMoreBtn.length; i++) 
        {
            let moreText = boxes[i].getElementsByTagName('span')[0];
            readMoreBtn[i].addEventListener('click', (e) => {moreText.style.display="flex"}, false)
        }
}   
