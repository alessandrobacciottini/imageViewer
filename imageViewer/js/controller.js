
$.getScript("js/model.js", function(){
  //includo il modello in questo modo
});




$(document).ready(function () {
	// al caricamento della pagina, recupero le immagini caricate dall'utente loggato con chiamata ajax (il controller interroga il modello)
	var array_files = new Array();
			$.ajax({
			url: "getdata.php",
				data: {action: "get_files"},
				type: "GET",
				async: true,
				dataType: 'json',
				success: function (data) {
					
					for (var i = 0; i < data.length; i++)
					{
						array_files[i] = {
						user: data[i].file['user'],
						image: data[i].file['image'],
						count: i+1
						};
						$("#user_gallery").append('<figure class="inline"><img class="myImg" id="myImg'+array_files[i]['count']+'" name="imgModal'+array_files[i]['count']+'" src="uploads/'+array_files[i]['image']+'" alt="" onclick="selectModal(this,'+array_files[i]['count']+')"/></figure> <div id="imgModal'+array_files[i]['count']+'" class="modal"><span class="close">&times;</span><img class="modal-content"  id="img'+array_files[i]['count']+'" ><button id="rotation" type="button" class="rotate" data-dismiss="modal">Ruota</button><button id="exif" type="button" class="exif" data-dismiss="modal">Vedi exif</button></div><div id="exifModal'+array_files[i]['count']+'" class="modal"><div class="table-responsive"><table id="table'+array_files[i]['count']+'"><tr><th>TAG</th><th>Value</th></tr></table></div><span class="closeExif">&times;</span></div>');

					};
				}
			});
	
	
});



function processKey(e)
{
    if (null == e)
        e = window.event ;
    if (e.keyCode == 82 && modalSelected==true && modalExifSelected==false)  {         //se sono nella visualizzazione immagine e premo R, si ruota
		var img='img'+selImg;
		var currentImg = document.getElementById(img);
		var deg=90*countRot;
		countRot=countRot+1;
 		currentImg.style.transform="rotate("+deg+"deg)"; 
		//alert(currentImg);
    }
	if(e.keyCode == 88 && modalSelected==true && modalExifSelected==false){      //se sono nella visualizzazione immagine e premo X, si chiude il modal
		modalCurrent.style.display = "none";
		modalSelected=false;
		selImg=null;
		countRot=1;
		SelectedSpan=null;
		modalCurrent=null;
	}
	if(e.keyCode == 88 && modalExifSelected==true){               //se sono nella visualizzazione exif e premo R, si chiude il modal
		modalExifCurrent.style.display = "none";
		modalExifCurrent=null;
		modalExifSelected=false;
		SelectedExifSpan=null;
	}
}

//funzione chiamata premendo sull'immagine della gallery per aprire il modal di visualizzazione
function selectModal(element,count){
	var name=element.getAttribute("name");
	var id=element.getAttribute("id");
	var modal = document.getElementById(name);
	modalCurrent=modal;
	document.onkeypress = processKey;
	
// prendo l'immagine e la inserisco nel modal
	var img = document.getElementById(id);
	var idModalImg = 'img'+count;
	var modalImg = document.getElementById(idModalImg);
	var captionText = document.getElementById("caption");
    modal.style.display = "block";
    modalImg.src = img.src;
	selImgName=modalImg.src;

    modalSelected=true;
	selImg=count;
	// prendo gli elementi che servono all'interno del modal
	var span = document.getElementsByClassName("close")[count-1];
	SelectedSpan=span;
	var exSpan = document.getElementsByClassName("closeExif")[count-1];
	SelectedExSpan=exSpan;
	var rotate = document.getElementsByClassName("rotate")[count-1];
	var exif = document.getElementsByClassName("exif")[count-1];

// chiusura modal visualizzazione immagine premendo [x] o X da tastiera
	span.onclick = function() { 
		modal.style.display = "none";

		modalSelected=false;
		selImg=null;
		countRot=1;
		SelectedSpan=null;
		modalCurrent=null;
	}
	// chiusura modal visualizzazione dati exif premendo [x] o X da tastiera
	exSpan.onclick = function() { 
		modalExifCurrent.style.display = "none";

		modalExifSelected=false;
		modalExifCurrent=null;
		var table = document.getElementById(tableSelected);
		var firstRow = table.rows[0];
		var tBody = table.tBodies[0].cloneNode(false);
		tBody.appendChild(firstRow);
		table.replaceChild(tBody, table.tBodies[0]);
		tableSelected=null;
		SelectedExSpan=null;
	}
	//rotazione immagine
	rotate.onclick = function() { 
		var img='img'+selImg;
		var currentImg = document.getElementById(img);
		//alert(currentImg);
		var deg=90*countRot;
		countRot=countRot+1;
 		currentImg.style.transform="rotate("+deg+"deg)"; 
	}
	//visualizzazione dati exif
	exif.onclick = function(){
		var exModalId='exifModal'+count;
		var exModal = document.getElementById(exModalId);
		modalExifCurrent=exModal;
		modalExifSelected=true;
		exModal.style.display = "block";
		var tableId = "table"+count;
		tableSelected=tableId;
		var table = document.getElementById(tableId);
		//chiamata ajax per recuperare i dati exif
		$.ajax({
			url: "exif.php",
			data: {action: "calc_exif",imgSel: selImgName},
			type: "GET",
			async: true,
			dataType: 'json',
			success: function (data) {
 				lengthExif=Object.keys(data).length;

				for(var i=0;i<lengthExif;i++){
					
					var key=Object.keys(data)[i];

					$("#"+tableId+"").append('<tr><td align="center">'+key+'</td><td align="center">'+data[key]+'</td></tr>');

				
				}}
		});
	}
	

}
