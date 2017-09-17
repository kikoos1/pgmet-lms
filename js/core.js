//General funtions
var q_id = 0;
var answ = {};
start = 0;
function Get_test()
{ 
     var test_id = GetUrlValue('id');
    var request = Request();
    request.onreadystatechange = function()
    {
        if(request.readyState == 4 && request.status == 200)
            {
                var data = request.responseText;
                document.getElementById('test').innerHTML = data;
            }
    }
        request.open("GET","test.php?id="+test_id+"&q_id="+q_id,true);
        request.send();
}
function Make_ans(id)
    {
        var ans;
        if(document.getElementById('opt_a').checked)
        {
            ans = document.getElementById('opt_a').value
        }else if(document.getElementById('opt_b').checked)
        {
            ans = document.getElementById('opt_b').value
        }
        else if(document.getElementById('opt_c').checked )
        {
            ans = document.getElementById('opt_c').value
        }
        else if(document.getElementById('opt_d').checked)
        {
            ans = document.getElementById('opt_d').value
        }else
        {
            ans = "f";
        }
        answ[id] = ans;
        console.log(answ);

          
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

function UP()
{
    Make_ans(q_id);
    q_id++;
    Get_test();
   
}
function Down()
{
   Make_ans(q_id);
    q_id--;
    Get_test();
   
}
function Send_ans()
{
    var test_id = GetUrlValue('id');
    var request = Request();
    request.onreadystatechange = function()
    {
        if(this.readyState = 4 && this.status == 200)
            {
                var data = request.responseText;
                document.getElementById('test').innerHTML = data;

            }
    }
    var test_id = GetUrlValue('id');
        request.open("POST","test.php",true)
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        answ = Json_to_string(answ);
        request.send("answ="+answ+"&test_id="+test_id);
        
}function convert_to_json(object)
{
    var json = "{";
    for(property in object)
    {
        var value = object[property];
        if(typeof(value)== "string")
        {
            json+='"'+property+'":"'+value+'",';
        }
        else if(!value[0])
        {
            json+='"'+property+'":"'+conver_to_json(value)+'",';
        }
        else
        {
            json +='"'+property+'":[';
            for(prop in value)
            {
                json += '"'+value[prop]+'",';
                json.substr(0,json.length-1)+"]";
            }
        }
        return json.substr(0,json.lengh-1)+"}";
    }
}
function Json_to_string(value)
{
    return JSON.stringify(value)
}
function Start_test()
{
    q_id++;
    Get_test();
}
function Get_tests()
{
    var request = Request();
    request.onreadystatechange  =function()
    {
        if(this.readyState == 4 & this.status == 200  )
        {
            var data  = request.responseText;
            document.getElementById('tests').innerHTML += data;
        }
    }
    request.open("GET",'functions.php?start='+start);
    request.send();
    start++;
}
window.onscroll = function()
{
    Scroll();
}
function Scroll()
{
    var wrap = document.getElementById('tests');
    var contentHeight = wrap.offsetHeight;
    var yoffset = window.pageYOffset;
    var y = yoffset + window.innerHeight;
    if(y >= contentHeight)
        {
            Get_tests();
            
        }
}
function Get_Results()
{
    var request = Request();
    request.onreadystatechange = function()
    {
        if(this.readyState == 4 & this.status == 200)
        {
            var data = this.responseText;
            document.getElementById('results').innerHTML += data;
        }
    }
}