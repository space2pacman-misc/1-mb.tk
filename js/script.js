var file = $(".file");
var addFile = $(".add-file");
var link = $(".link");
var progressBar = $(".progress-bar");
var maxSize = 1000000;

addFile.on("click", function() {
	file.trigger('click'); 
})

$(document).on("click", ".anew", function(){
	file.val("");
	link.fadeOut();
	addFile.fadeIn();
})

file.on("change", function(e) {
	var fileData = $(this).prop('files')[0];
	var formData = new FormData();
	var anew = "<span class='anew'>Назад</span>"

	if(fileData.size > maxSize) {
		addFile.fadeOut();
		link.fadeIn();
		link.html("Файл больше 1 МБ. " + anew);	
		return;
	}

	addFile.fadeOut();
	progressBar.fadeIn();

	formData.append('file', fileData);
	$.ajax({
		url: "load.php",
		type: "POST",
		contentType: false,
		processData: false,
		data: formData,
		xhr: function(){
			var xhr = $.ajaxSettings.xhr();
			xhr.upload.addEventListener('progress', function(evt){

				if(evt.lengthComputable) {
					var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
					$(".progress-line").css({"width": percentComplete + "%"});
				}
			}, false);
			return xhr;
		},
		success: function(data) {
			progressBar.fadeOut();
			link.fadeIn();
			link.html(data);
		}
	})
})