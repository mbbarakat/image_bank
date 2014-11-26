function imageClicked(image){
	console.log(image);
    showPopup(image);
}

function showPopup(image){
    var popup = document.getElementById("popup");
    var background = document.getElementById("background");
    popup.style.display = 'block';
    background.style.display = 'block';

    showInformation(image);
}

function hidePopup(){
    var popup = document.getElementById("popup");
    var background = document.getElementById("background");
    popup.style.display = 'none';
    background.style.display = 'none';
}

function showInformation(image){
    document.getElementById("hiddenFormId").value = image.fileid;
    document.getElementById("hiddenFormTitle").value = image.title;
    document.getElementById("hiddenFormDescription").value = image.description;
    document.getElementById("hiddenFormFilename").value = image.filename;

	document.getElementById("formFilename").value = image.filename.split(".").slice(0, -1).join(".");
	document.getElementById("formTitle").value = image.title;
	document.getElementById("formDescription").value = image.description;
	document.getElementById("formType").value = image.type;
	document.getElementById("formSize").value = bytesToSize(image.size);
	document.getElementById("formWidth").value = image.width;
	document.getElementById("formHeight").value = image.height;
	document.getElementById("formUploaded").value = image.uploaded;
	document.getElementById("formupdated").value = image.updated;
	document.getElementById("formImage").src="image.php?id=" + image.fileid + "&label=_small" + "&ext=" + image.type;
	document.getElementById("formDownload").href="image.php?id=" + image.fileid + "&ext=" + image.type + "&download=true";
}

function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    if (i == 0) return bytes + ' ' + sizes[i]; 
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
};