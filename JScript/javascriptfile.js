const XHRSTATE = 4;
const XHRSTATUS = 200;

function Error(error)
{
    alert("Error :", error);
}
function SearchPurchase()
{
    try
    {
        console.log("Working");
        var xhr = getXmlHttpRequest();
        xhr.onreadystatechange = function()
        {
            if(xhr.State == XHRSTATE && xhr.status == XHRSTATUS)
            {
                document.getElementById('Result').innerHTML = xhr.responseText;
            }
        }
        xhr.open("POST", 'SearchPurchasesPage.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var search = document.getElementById('searchQuery').value;
        xhr.send('searchQuery=' + search);
    }
    catch(error)
    {
        Error(error);
    }
}
function getXml()
{
    try
    {
        var xhr = null;
        if(window.XML)
        {
            xhr = new XML();
        }
        return xhr;
    }
    catch(error)
    {
        Error(error);
    }
}


