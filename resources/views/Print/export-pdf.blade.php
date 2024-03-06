<html>
<body>
<table cellspacing="0" cellpadding="2" class="tablepdf">
    {!! $data !!}
</table>
</body>
</html>

<style>
    body{
        font-size:12px;
        margin: 0;
        padding:0 ;
        font-family: Arial,Helvetica, sans-serif;
        font-size:12px;
    }
 .tablepdf{ width:100%;  border:1px solid silver;}
.tablepdf thead tr th{  padding:2px 2px;  background-color:whitesmoke; border-bottom:1px solid silver; border-right:1px solid silver; font-weight:bold;  }
.tablepdf thead tr td{   padding:2px 2px; background-color:whitesmoke; border-bottom:1px solid silver; border-right:1px solid silver; font-weight:bold;  }
.tablepdf tbody tr td{  font-weight:bold; border-bottom:1px solid silver; border-right:1px solid silver;   }
.text-center{ text-align:center; }
.text-left{ text-align:left; }
    @page {
        margin-bottom:0px;
    }
    .page-break {
        page-break-after: always;
    }
</style>
