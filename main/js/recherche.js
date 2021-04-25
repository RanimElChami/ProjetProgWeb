function incremquant(obj,quantacht){ //incremente la quantité d'un produit
	quantacht+=1;
	document.getElementById("quantiacht2").innerHTML=quantacht;
}
function decquant(obj,quantacht){  //décremente la quantité d'un porudit
	if(quantacht!=0){
   quantacht-=1;
   document.getElementById("quantiacht3").innerHTML=quantacht; 
 }
}
