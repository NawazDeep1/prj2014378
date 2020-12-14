//defininf constants
const XHRSTATE = 4;
const XHRSTATUS = 200;

//to handle error
function Error(error)
{
    alert("Error :", error);
}

//function to search in purchasses
function SearchPurchase()
{
    try
    {
        var xhr = getXmlHttpRequest();
        xhr.onreadystatechange = function()
        {
            if(xhr.State == XHRSTATE && xhr.status == XHRSTATUS)
            {
                document.getElementById('Result').innerHTML = xhr.responseText;
            }
        }
        xhr.open("POST", 'SearchPurchasesPage.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        var search = document.getElementById('searchQuery').value;
        xhr.send('searchQuery=' + search);
    }
    catch(error)
    {
        Error(error);
    }
}
//function for browsers
function getXml()
{
    try
    {
        var xhr = null;
        if(window.XML)
        {
            xhr = new XML();
        }
        else
        {
            alert("not suporting browser")
        }
        return xhr;
    }
    catch(error)
    {
        Error(error);
    }
}



