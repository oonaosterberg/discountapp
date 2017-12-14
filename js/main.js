'use strict';

/*

const  xhr = new XMLHttpRequest();

const showImages = function(){
  if(xhr.readyState === 4 && xhr.status === 200){
    const json = JSON.parse(xhr.responseText);
    let output = '';
    for(const i in json){
      output += '<li>' +
          '<figure>' +
          '<a href="imgpage.php?kuva=' + json[i].Img_url + '"><img src="img/thumbs/' +
          json[i].img_url + '"></a>' +
          '<figcaption>'+
          '</figcaption>' +
          '</figure>' +
          '</li>';
    }

    document.querySelector('ul').innerHTML = output;
//specify also two elements like <p> with id in index.php
  }
};

xhr.open('GET', 'jsonDiscounts.php');
xhr.onreadystatechange = showImages;
xhr.send();


