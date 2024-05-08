function printPageArea(divId){
    var printedContent = document.getElementById(divId).innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = printedContent;
    window.print();
    document.body.innerHTML = originalContent;
}