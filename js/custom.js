function chooseFile(id, file_id) {
	if (!window.File || !window.FileReader || !window.FileList || !window.Blob) {
		alert('The File APIs are not fully supported in this browser.');
		return;
	}
	var input = document.getElementById(file_id);
	var intIndex = document.getElementById("count").value;
	for ( var i = 0; i < input.files.length; i++) {
		var fd = new FormData();
		fd.append('file', input.files[i]);
		var oFReader = new FileReader();
		oFReader.filename = input.files[i].name;
		oFReader.filesize = input.files[i].size;
		oFReader.readAsDataURL(input.files[i]);
		
		oFReader.onload = function(oFREvent) {
			
			$('#' + id).append('<li id="li'+ intIndex +'"><span onclick="return removeFromList('+ intIndex + ');" class="remove-folder"></span><a href="javascript:void(0)" onclick="return removeFromList('+ intIndex + ');"><img src="' + oFREvent.target.result + '" /></a></li>');
			intIndex++;
			document.getElementById("count").value = intIndex;
		}
	}
}

function createUploadField() {
	var file_id = "upload_" + makeid();
	var file_upload = document.createElement("input");
	file_upload.setAttribute("type", "file");
	file_upload.setAttribute("name", "upload[]");
	file_upload.setAttribute("id", file_id);
	file_upload.setAttribute("style", "display:none");
	file_upload.setAttribute("multiple", "true");
	file_upload.setAttribute("onchange", "return chooseFile('uploaded','" + file_id + "');");
	document.getElementById("upload_field").appendChild(file_upload);
	file_upload.click();
}
function removeFromDb(id) {
	var list = document.getElementById("removeDb").value;
	if(list == "") {
		list = id;
	} else {
		list = list + "," + id;
	}
	
	document.getElementById("removeDb").value = list;
	var parent = document.getElementById("uploaded");
	var child  = document.getElementById("li_edit" + id);
	parent.removeChild(child);
}
function removeFromList(index) {
	var list = document.getElementById("removeList").value;
	if(list == "") {
		list = index;
	} else {
		list = list + "," + index;
	}
	
	document.getElementById("removeList").value = list;
	var parent = document.getElementById("uploaded");
	var child  = document.getElementById("li" + index);
	parent.removeChild(child);
}

function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

function openDialog(id) {

	if (id != undefined && id != '') {
		document.getElementById(id).click();
	} else {
		document.getElementById('file').click();
	}
}

function openManager(base_url, folder, preview_id, control_id) {
	var childWin = window
			.open(base_url + "admin/files/manager/" + folder, "File Manager",
					"width=800,height=550,left=200,top=5,scrollbars,toolbar=0,resizable=0");
}

function showSmallMenu() {

	if (document.getElementById("quick").style.display == "block") {
		document.getElementById("quick").style.display = "none";
	} else {
		document.getElementById("quick").style.display = "block";
	}
}

function checkAllRow() {
	var listChk = document.getElementsByClassName('remove-chk');
	for ( var i = 0; i < listChk.length; i++) {

		if (!listChk[i].checked) {
			listChk[i].checked = true;
		} else {
			listChk[i].checked = false;
		}
	}
}

function doConfirm($msg, url) {

	if (confirm($msg)) {
		doSubmit(url);
		return true;
	}
	return false;
}

function onDestroyOrder(base_url) {
	if (!confirm('Hủy hàng này?Bạn có đồng ý không?')) {
		return false;
	}
	document.getElementById('status').value = 6;
	var theForm = document.getElementById("form");
	theForm.action = base_url;
	theForm.submit();
}

function doSubmit(base_url) {
	var segment = base_url.split('/');
	if (segment[segment.length - 1] == 'confirm') {
		var index = document.getElementById("index").value;
		if (index == 0) {
			alert('Bạn chưa đăng ký dòng nào');
			return false;
		}

	}
	if (segment[segment.length - 3] == 'orders') {
		if (!confirm('Cập nhật thay đổi cho đơn hàng này?\n               Bạn có đồng ý không?')) {
			return false;
		}
	}

	var theForm = document.getElementById("form");
	theForm.action = base_url;
	theForm.submit();
}

function doClear() {
	document.getElementById('search_name').value = '';
	document.getElementById('datefrom').value = '';
	document.getElementById('dateto').value = '';
	document.getElementById('category_id').selectedIndex = 0;
	document.getElementById('brand_id').selectedIndex = 0;
	return false;
}

function updateOrder(status) {
	var base_url = document.getElementById('base_url').value;
	var status_bar = document.getElementById('status_bar');
	status_bar.src = base_url + "img/process/step" + status + ".png";
	document.getElementById('status').value = status;
	$('.cur-status').removeClass('cur-status');
	$('#step-' + status + ' a').addClass('cur-status');

}

function doPrint(url) {
	window
			.open(url, "In ĐH",
					"width=800,height=800,left=200,top=5,scrollbars,toolbar=0,resizable");
}

function openChild(id) {
	document.getElementById('child' + id).style.display = 'block';
}

function callAjax(table, value) {
	var url = document.getElementById('base_url').value;
	var form_data = {
		'value' : value,
		'table' : table
	}
	$.ajax( {
		url : url = url + "apis/getList",
		type : "POST",
		data : form_data,
		success : function(data) {
			$("#order_by").html(data);
		}
	});
}
function sendFile(src, folder_id,ev) {
	if (ev.ctrlKey) {
        document.getElementById('img' + folder_id).className = document.getElementById('img' + folder_id).className + " selectedImg";
        ev.preventDefault(); 
    } else {
    	
    	if (src.lastIndexOf('/') < 0) {
    		var root_path = document.getElementById('path').value;
    		root_path = root_path + src + "/";
    		document.getElementById('path').value = root_path;
    		document.getElementById('mode').value = 'init';
    		var theForm = document.getElementById("form");
    		theForm.submit();
    	} else {
    		var dir = document.getElementById('root').value;
    		if(dir == 'upload/system_1/products/') {
    			var html = "";
    			var id   = "";
				html += "<img class='select-product-img' src='" + src + "' title='Click để làm hình đại diện sản phẩm' onclick='return pickImg(this," + folder_id + ")' />";
				id += "," + folder_id;
    				
    			window.opener.list_img.innerHTML = html + window.opener.list_img.innerHTML;
    			window.opener.file_id.value = window.opener.file_id.value + id;
    			self.close();
    			return;
    		}
    		var preview = document.getElementById("myPreview").value;
    		if (opener.document.f1 != undefined) {
    			opener.document.f1.src.value = src;
    		} else if(preview == "ico_preview") {
    			window.opener.ico_id.value 	  = folder_id;
				window.opener.ico_preview.src = src;
    		} else if(preview == "logo_preview") {
    			window.opener.logo_id.value   = folder_id;
				window.opener.logo_preview.src     = src;
    		} else {
    			window.opener.preview.src = src;
    			window.opener.file_id.value = folder_id;
    		}

    		self.close();
    	}
    }
	
}

function createFolder() {
	var folderName = prompt("Nhập tên thư mục:");
	if (folderName != null) {
		document.getElementById('mode').value = 'create_folder';
		document.getElementById("new_folder_name").value = folderName;
		var theForm = document.getElementById("form");
		theForm.submit();
	}
}

function renameFolder(oldName) {
	var folderName = prompt("Nhập tên thư mục:", oldName);
	if (folderName != null) {
		document.getElementById('mode').value = 'rename_folder';
		document.getElementById("new_folder_name").value = folderName;
		document.getElementById("old_folder_name").value = oldName;
		var theForm = document.getElementById("form");
		theForm.submit();
	}
}

function removeFile(id) {
	if (confirm('Hình ảnh này có thể đang được sử dụng.Bạn đồng ý xóa?')) {
		document.getElementById('mode').value = 'remove_file';
		document.getElementById("new_folder_name").value = id;
		var theForm = document.getElementById("form");
		theForm.submit();
	} else {
		return false;
	}
}

function removeFolder(id, folderName) {
	if (confirm('Xóa thư mục sẽ xóa tất cả hình ảnh của thư mục đó.\n.                          Bạn có chắc chắn xóa?')) {
		document.getElementById('mode').value = 'remove_folder';
		document.getElementById("new_folder_name").value = id;
		document.getElementById("old_folder_name").value = folderName;
		var theForm = document.getElementById("form");
		theForm.submit();
	} else {
		return false;
	}
}

function backFolder() {
	var path = document.getElementById('path').value;
	var arrPath = path.split('/');
	var new_path = '';
	for ( var i = 0; i < arrPath.length - 2; i++) {
		new_path += arrPath[i] + '/';
	}
	document.getElementById('path').value = new_path;
	document.getElementById('mode').value = 'init';
	var theForm = document.getElementById("form");
	theForm.submit();
}

function uploadAuto() {
	document.getElementById('mode').value = 'upload_file';
	var theForm = document.getElementById("form");
	theForm.submit();
}

function selectAll() {
	var selectImgList = document.getElementsByClassName("selectedImg");
	var cnt = selectImgList.length;
	var html = "";
	var id   = "";
	for(var i = 0; i < cnt; i++) {
		html += "<img class='select-product-img' src='" + selectImgList[i].getElementsByTagName("img")[0].src + "' title='Click để làm hình đại diện sản phẩm' onclick='return pickImg(this," + selectImgList[i].getElementsByTagName("input")[0].value + ")' />";
		id += "," + selectImgList[i].getElementsByTagName("input")[0].value;
		
	}
	window.opener.list_img.innerHTML = html + window.opener.list_img.innerHTML;
	window.opener.files_id.value = window.opener.files_id.value + id;
	self.close();
}

function pickImg(obj,id) {
	var picked = document.getElementsByClassName('picked');
	for(var i = 0; i < picked.length; i++) {
		picked[i].className = 'select-product-img';
	}
	obj.className = obj.className + ' picked';
	document.getElementById('file_id').value = id;
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
} 

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
function showTab(obj,div_id) {
	$(".tab-view").slideUp();
	$("#" + div_id).slideDown();
	$(".active").removeClass("active");
	$(".first-child").removeClass("first-child");
	obj.className = "active";
}
