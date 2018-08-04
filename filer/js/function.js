var innerHTML = "";

function saveToDatabase(editableObj,column,id) {
    $(editableObj).css("background","#f00");
    var input = column === "phone" ? editableObj.innerHTML.trim().match(/(\d{2,3}\s\d{2}\s\d{2,3}(\s\d{2})?)/g) : editableObj.innerHTML.trim();
    if(Array.isArray(input)) {
        var temp = "";
        for (var i = 0; i < input.length; i++){
            if(i === input.length-1)
                temp += input[i];
            else
                temp += input[i] + "<br>";
        }
        input = temp;
    }
    $.ajax({
        url: "filer/saveedit.php",
        type: "POST",
        data:'column='+column+'&editval='+input+'&id='+id,
        success: function(data){
            $(editableObj).css("background","#069b09");
            editableObj.innerHTML = input;
        }
    });

}

function showEdit(editObj) {
    innerHTML = editObj.innerHTML;
    if (editObj.parentElement.getAttribute("contenteditable") === "True"){
        $(editObj).css({
            "background": "#FFF",
            "border": "1px solid #black",
            "color": "black"
        });
    }
}