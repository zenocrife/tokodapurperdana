// For todays date;
Date.prototype.today = function () { 
    return ((this.getDate() < 10)?"0":"") + this.getDate() + (((this.getMonth()+1) < 10)?"0":"") + (this.getMonth()+1) + this.getFullYear();
}

// For the time now
Date.prototype.timeNow = function () {
     return ((this.getHours() < 10)?"0":"") + this.getHours() + ((this.getMinutes() < 10)?"0":"") + this.getMinutes() + ((this.getSeconds() < 10)?"0":"") + this.getSeconds();
}

function CreatePDFfromHTML() {
    var HTML_Width = $(".html-content").width();
    var HTML_Height = $(".html-content").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($(".html-content")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("print/.pdf");
        $(".html-content").hide();
    });
}

$("#print-button").click(function () {
    // var output = $("#table-output").html();
    var curDate = new Date();

    // var fileName = curDate.getDate() + "-" + (curDate.getMonth()+1) + "-" + curDate.getFullYear() + "-" + curDate.getHours() + "-" + curDate.getMinutes() + "-" + curDate.getSeconds();

    var fileName = curDate.today() + "-" + curDate.timeNow();

    // $("#print-fileName").val(fileName);
    // $("#print-output").html(output);
    var oldHtml = $("#table-output").html();
    var print = "<h2>Laporan Penjualan</h2>" + $("#table-output").html();

    $("#table-output").html(print);

    var HTML_Width = $("#table-output").width();
    var HTML_Height = $("#table-output").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("#table-output")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save(fileName+".pdf");
        $("#table-output").html(oldHtml);
    });
});