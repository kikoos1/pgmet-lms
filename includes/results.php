<?php
include "functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Резултати</title>

</head>
<body>
    <section id = 'test_nav'>
            <select id="test" onchange = "Filter_results(document.getElementById('test').value)"><<option value= "">--</option>
            <?php Get_Classes(); ?>
            </select>
    </section>
<section >
<table id = 'results'>

<th>ID</th>
<th>Потр.име</th>
<th>Име</th>
<th>Клас</th>
<th>Тест</th>
<th>Дата на теста</th>
<th>Резултат</th>

</table>

</section>
</body>
<script>
    start = 0;
    window.onload = function()
    {
        Get_Results();
    }
    window.onscroll = function()
{
    Scroll();
}
function Scroll()
{
    var wrap = document.getElementById('posts');
    var contentHeight = wrap.offsetHeight;
    var yoffset = window.pageYOffset;
    var y = yoffset + window.innerHeight;
    if(y >= contentHeight)
        {
            Get_Results();
            
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
    request.open("GET",'results_controller.php?startt='+start);
    request.send();
    start+=5;
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
    
    
    function Filter_results(filter)
    {
        start = 0;
        var clas = filter;
        var request = Request();
        request.onreadystatechange = function()
        {
            if(this.readyState == 4 & this.status == 200)
        {
            var data = this.responseText;
            document.getElementById('results').innerHTML = `<table id = 'results'>

<th>ID</th>
<th>Потр.име</th>
<th>Име</th>
<th>Клас</th>
<th>Тест</th>
<th>Дата на теста</th>
<th>Резултат</th>`+
data+`
</table>`;
        }
    }
    request.open("GET",'results_controller.php?startt='+start+"&class="+clas);
    request.send();
    start+=5;
        }
</script>
</html>