function myFunction($td) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($($td).text()).select();
  document.execCommand("copy");
  $temp.remove();
  alert("Texto Copiado en el portapapeles: " + $td.innerHTML);
}

function addEvents () {
	$('#the-list tr td[id]').click(function($this){
		myFunction(this);
	});

}
addEvents();


