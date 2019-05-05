/**
 * Created by w16015928 on 09/11/2017.
 */
function changeColour( id, colour) {
    var elem = document.getElementById(id);
    elem.style.color = colour;
}

function makeVisible(visID, invisArr) {
    var visElem = document.getElementById(visID);
    var hiddenElement;
    // process the array of things to make invisible
  //  for each (var element in invisArr)
   // {
     //   hiddenElement = document.getElementById(element);
      //  hiddenElement.style.visibility = 'hiidden';
  //  }
    for (var n=0; n < invisArr.length; n++) {
        hiddenElement = document.getElementById(invisArr[n]);
        hiddenElement.style.visibility = 'hidden';
    }
    // make the visElem visible
    visElem.style.visibility = 'visible';
}