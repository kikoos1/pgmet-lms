//general functions
var clicks = 0;
var q_id=1;
function Show(items)
{
    var elems = items;
            document.getElementById(items).style.display = "block";
        
}
function Hide(items)
{
    var elems = items;
  
            document.getElementById(elems).style.display = "none";

}
function Change_Html(values,items)
{
    var val = values;
    var item = items;
    for(var i =0 ;item.lenght;i++)
        {
            document.getElementById(item[i]).innerHtml += document.getElementById(val[i]).value; ;
        }
}
 function UP()
{
    clicks++;
    switch(clicks)
        {
            case 1:
            Hide('question');
            Show('opt_a');
            break;
            case 2:
            Hide('opt_a');
            Show('opt_b');
            break;
            case 3:
            Hide('opt_b');
            Show('opt_c');
            break;
            case 4:
            Hide('opt_c');
            Show('opt_d');
            break;
            case 5:
            Hide('opt_d');
            Show('select');
            break;
            case 6:
            Hide('select');
            Show('buttons');
            break;
        }
}
function Down()
{
    clicks--;
     switch(clicks)
        {
             case 0:
             Hide('opt_a');
             Show('question');
             break;
            case 1:
            Hide('opt_b');
            Show('opt_a');
            break;
            case 2:
            Hide('opt_c');
            Show('opt_b');
            break;
            case 3:
            Hide('opt_d');
            Show('opt_c');
            break;
            case 4:
            Hide('opt_c');
            Show('opt_d');
            break;
            case 5:
            Hide('select');
            Show('option_d');
            break;
            case 6:
            Hide('select');
            Show('buttons');
            break;
        }
}

function GetUrlValue(VarSearch){
    var SearchString = window.location.search.substring(1);
    var VariableArray = SearchString.split('&');
    for(var i = 0; i < VariableArray.length; i++){
        var KeyValuePair = VariableArray[i].split('=');
        if(KeyValuePair[0] == VarSearch){
            return KeyValuePair[1];
        }
    }
}
function Request()
{
    var request = new XMLHttpRequest();
    try
        {
            request = new XMLHttpRequest();
        }
    catch(e)
        {
            try
                {
                    request = new ActiveXObject("MICROSOFT.XMLHTP");
                }catch(err)
                    {
                        console.log(err);
                    }
        }
                return request;
}
