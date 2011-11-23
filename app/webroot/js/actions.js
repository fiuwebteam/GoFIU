/* COPY TO CLIPBOARD
----------------------------------------------- */
function copyToClipboard(){

	
	//set path
	ZeroClipboard.setMoviePath('http://www.fiudevspace.com/tinyurl/js/ZeroClipboard.swf');
	//create client
	var clip = new ZeroClipboard.Client();
	var text;
	//event
	clip.addEventListener('mousedown',function() {
		clip.setText(document.links["newLink"].href);
	});	
	clip.addEventListener('complete',function(client,text) {
		alert('copied: ' + text);
	
	});

	//glue it to the button
	clip.glue('my_clip_button');

};