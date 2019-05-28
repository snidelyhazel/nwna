function modalize()
{
  var modal = document.getElementById("modal-map");
  var close = document.getElementsByClassName("close")[0];

  modal.style.display = "block";

  close.onclick = function()
  {
    modal.style.display = "none";
  }

  window.onclick = function(event)
  {
    if (event.target == modal)
    {
      modal.style.display = "none";
    }
  }
}

function imgcycle(imgURLs, imgcaptions)
{
  var prev = document.getElementsByClassName("prev")[0];
  var next = document.getElementsByClassName("next")[0];

  var imgelement = document.getElementById("mapview");
  var capelement = document.getElementById("mapcap");

  var index = 0;

  imgelement.src = imgURLs[index];
  capelement.innerHTML = imgcaptions[index];

  prev.onclick = function (event)
  {
    if (index > 0)
    {
      index--;
    }
    else
    {
      index = imgURLs.length - 1;
    }

    imgelement.src = imgURLs[index];
    capelement.innerHTML = imgcaptions[index];
  }

  next.onclick = function (event)
  {
    if (index < imgURLs.length - 1)
    {
      index++;
    }
    else
    {
      index = 0;
    }

    imgelement.src = imgURLs[index];
    capelement.innerHTML = imgcaptions[index]; 
  }

}
