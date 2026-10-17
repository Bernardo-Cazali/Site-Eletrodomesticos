var intervalo=5000;

function slide(){
	     document.getElementById("banner").src="imagem/gel1.jpg";
	     setTimeout("slide2()",intervalo);}
		 
function slide2(){ 
         document.getElementById("banner").src="imagem/fr.jpg";
		 setTimeout("slide3()",intervalo);}

function slide3(){
	     document.getElementById("banner").src="imagem/nt.jpg";
         setTimeout("slide4()",intervalo);}
		 
function slide4(){
	     document.getElementById("banner").src="imagem/mg.jpg";
         setTimeout("slide5()",intervalo);}
		 
function slide5(){
	     document.getElementById("banner").src="imagem/ds.jpg";
         setTimeout("slide()",intervalo);}
