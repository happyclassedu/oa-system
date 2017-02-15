
function asecBoard(n)
{
    for(i=1;i<4;i++)
    {
        eval("document.getElementById('al0"+i+"').className='a102'");
        eval("abx0"+i+".style.display='none'");
    }
    eval("document.getElementById('al0"+n+"').className='a101'");
    eval("abx0"+n+".style.display='block'");
}