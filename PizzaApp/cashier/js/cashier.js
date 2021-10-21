function billheight(){
    var d = new Date(); // for now
    d.getHours()+'-'+d.getMinutes()+'-'+d.getSeconds();
    document.getElementById("time").innerHTML = d;
    document.getElementById("BillViewer").style.display = 'flex';
}

function tableArray(){

var TableData = new Array();
$('#table2 tr').each(function(row, tr){
    TableData[row]={
          "ProductName" :$(tr).find('td:eq(1)').text()
        , "ProductPrice" : $(tr).find('td:eq(2)').text()
        , "UserUploaded" : $(tr).find('td:eq(3)').text()
    }
}); 
TableData.shift();
bill(TableData);
return TableData;
}

function bill(TableData){

    var html = "<table id='res' class='table borderless'>";
    html+="<tr>";
    html+="<th>Product Name</th>";
    html+="<th>Price</th>";
    html+="</tr>";
    for(var i = 0; i < TableData.length; i++) {
        html+="<tr>";
        html+="<td name='productname' style='border:none;'>"+TableData[i].ProductName+"</td>";
        html+="<td name='productprice' class='countable' style='border:none; width:20%';>"+TableData[i].ProductPrice+"</td>";
        html+="</tr>";
    }
    html+="</table>";
    document.getElementById("box").innerHTML = html;

    var cls = document.getElementById("res").getElementsByTagName("td");
    var sum = 0;
    for (var i = 0; i < cls.length; i++){
        if(cls[i].className == "countable"){
            sum += isNaN(cls[i].innerHTML) ? 0 : parseInt(cls[i].innerHTML);
        }
        document.getElementById("total").innerHTML = sum ;
        document.getElementById("totalqty").innerHTML = cls.length/2 ;
    }
}

function tab1_To_tab2()
{
    var table1 = document.getElementById("table1"),
        table2 = document.getElementById("table2"),
        checkboxes = document.getElementsByName("check-tab1");

        for(var i = 0; i < checkboxes.length; i++)
            if(checkboxes[i].checked)
            {
                var newRow = table2.insertRow(table2.length),
                    cell1 = newRow.insertCell(0),
                    cell2 = newRow.insertCell(1),
                    cell3 = newRow.insertCell(2),
                    cell4 = newRow.insertCell(3);
                
                cell1.innerHTML = "<input type='checkbox' name='check-tab2'>";
                cell2.innerHTML = table1.rows[i+1].cells[1].innerHTML;
                cell3.innerHTML = table1.rows[i+1].cells[2].innerHTML;
                cell4.innerHTML = table1.rows[i+1].cells[4].innerHTML;
                tableArray();
            }
}


function tab2_To_tab1()
{
    var table1 = document.getElementById("table1"),
        table2 = document.getElementById("table2"),
        checkboxes = document.getElementsByName("check-tab2");
        for(var i = 0; i < checkboxes.length; i++)
            if(checkboxes[i].checked)
            {
                var index = table2.rows[i+1].rowIndex;
                table2.deleteRow(index);
                i--;
                tableArray();
            }
}

function save(){

    var TableData = new Array();
    $('#table2 tr').each(function(row, tr){
        TableData[row]={
            "ProductName" :$(tr).find('td:eq(1)').text()
            , "ProductPrice" : $(tr).find('td:eq(2)').text()
            , "UserUploaded" : $(tr).find('td:eq(3)').text()
        }
    }); 
    TableData.shift();
    
    var name2 = document.getElementById("name2").innerHTML;
    var time = document.getElementById("time").innerHTML;
    var invoiceid = document.getElementById("invoiceid").innerHTML;
    var totalqty = document.getElementById("totalqty").innerHTML;
    var total = document.getElementById("total").innerHTML;
    
    var info = new Array();
    var info = {name2,time,invoiceid,totalqty,total};
    
    console.log("Done");
    const toSend= TableData.concat(info);
    
    const jSonString = JSON.stringify(toSend);
    const xhr = new XMLHttpRequest();
    xhr.open("POST","recieve.php");
    xhr.setRequestHeader("Content-Type","application/json");
    xhr.send(jSonString);
}