'use strict';

// tällä seurataan montako palasta on lähetetty
let chunksSent = 0;

// valitaan elementit
const form = document.querySelector('#upForm');
const input = document.querySelector('#fileToUpload');
const pResult = document.querySelector('#result');
const body = document.querySelector('#body');
const faili = document.querySelector('#faili');

// TODO: valitse img-elementti
// TODO: valitse #progress elementti

const upload = (chunk, part, count, name) => {
  // tehdään FormData-olio ja lisätään tiedostopalanen ja sille nimi
  // sekä osan järjestysnumero (part)
  const data = new FormData();
  data.append('file', chunk, name);
  data.append('part', part);

  //console.log(chunk);


  // fetch pyynnön asetukset
  const settings = {
    method: 'post',
    body: data
  };

  // lähetetään tiedostopalanen
  fetch('upload.php', settings).then((response) => {
    return response.json();
}).then( (json) => {
    // TODO: näytä latauksen edistyminen #progress elementissä
    // päivittää tiedon montako palasta lähetetty
    chunksSent ++;
  console.log(json);
  // console.log(chunksSent);
  // kun viimeinen palanen on lähetetty
  if (chunksSent === count){
    // käynnistä tiedoston kokoaminen
    merge(count, name);
  }
});
};


const merge = (count, name) => {
  // merge.php kokoaa lähetetyt palaset takaisin kokonaiseksi tiedostoksi
  const url = `merge.php?count=${count}&name=${name}`;
  fetch(url).then((response) => {
    return response.json();
}).then( (json) => {
    //console.log(json);
  pResult.innerHTML = json.result + ' upload complete!';
  faili.value = json.result;
  // lähetä lomakkeen tiedot db_submit.php
  const data = new FormData(form);
   const settings = {
    method: 'post',
     credentials: 'same-origin',
    body: data
  };
  fetch('db_submit.php', settings).then((response) => {
    return response.text();
	}).then( (text) => {
  console.log(text);

  })

});
};


const process = (file) => {

  const BYTES_PER_CHUNK = 1024 * 1024;
  // 1 MB palasia
  const SIZE = file.size;

  // palasten lukumäärä
  const count = Math.floor(SIZE/BYTES_PER_CHUNK) + 1;

  // osien järjestysnumero
  let part = 1;

  // määritetään ensimmäisen palasen aloitus ja lopetuskohta
  let start = 0;
  let end = BYTES_PER_CHUNK;

  // ajetaan silmukkaa kunnes ollaan tiedoston lopussa
  while (start < SIZE) {
    //console.log('start: '+start+', SIZE: '+SIZE+', '+end);

    // tehdään tiedostopalanen
    const chunk = file.slice(start, end);

    // lähetetään palanen
    upload(chunk, part, count, file.name);

    // uudet aloitus- ja lopetuskohdat seuraavaa silmukkaa varten
    start = end;
    end = start + BYTES_PER_CHUNK;
    part++;
  }
//console.log('last part: '+part);


};

// kun lomake lähetetään...
form.addEventListener('submit', (evt) => {
  evt.preventDefault();
// näytetään käyttäjälle että jotain tapahtuu
//pResult.innerHTML = 'lomake lähetetty';

// haetaan tiedosto input-kentästä
const file = input.files[0];
//console.log(file.size);
// resetoidaan chucksSent
chunksSent = 0;
// aloitetaan viipalointi
process(file);
});