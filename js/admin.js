var url =window.location.href;
if (url.includes("?page=pedigree_uniko")) {

	function myFunction($td) {
	     var range = window.getSelection().getRangeAt(0);
	        range.selectNode($td);
	        window.getSelection().addRange(range);
	   document.execCommand("copy");
	  alert("Texto Copiado en el portapapeles: " + $td.innerHTML);

	}

	function addEvents () {
		document.querySelectorAll('#the-list tr td[id]').forEach(function($this){
			$this.addEventListener("click", function($this){
				myFunction(this);
			});
		});
	}
	addEvents();
}