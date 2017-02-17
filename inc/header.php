   <p class="a5" align="center">
<a href="/"><img src="logo.png" class="img-rounded" alt="logo" width="285" height="100"/></a></p>
<div id="header"><?PHP
if(file_exists('inc/counter.txt')){$CFile=fopen('inc/counter.txt',r);$CData=fread($CFile,filesize('inc/counter.txt'));$CFile=fopen('inc/counter.txt',w);fwrite($CFile,$CData+1);}else{$CStart="0";$fp=fopen("inc/counter.txt","wb");fwrite($fp,$CStart);fclose($fp);}?></div>