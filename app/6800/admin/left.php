<?php
include_once('admin_global.php');
$arr=UserShell($_SESSION[uid],$_SESSION[user_shell]);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>����ҳ��</TITLE>
<STYLE type=text/css>BODY {
	BACKGROUND: #799ae1; MARGIN: 0px; FONT: 9pt ����
}
TABLE {
	BORDER-RIGHT: 0px; BORDER-TOP: 0px; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px
}
TD {
	FONT: 12px ����
}
IMG {
	BORDER-RIGHT: 0px; BORDER-TOP: 0px; VERTICAL-ALIGN: bottom; BORDER-LEFT: 0px; BORDER-BOTTOM: 0px
}
A {
	FONT: 12px ����; COLOR: #000000; TEXT-DECORATION: none
}
A:hover {
	COLOR: #428eff; TEXT-DECORATION: underline
}
.sec_menu {
	BORDER-RIGHT: white 1px solid; BACKGROUND: #d6dff7; OVERFLOW: hidden; BORDER-LEFT: white 1px solid; BORDER-BOTTOM: white 1px solid
}
.menu_title {

}
.menu_title SPAN {
	FONT-WEIGHT: bold; LEFT: 7px; COLOR: #215dc6; POSITION: relative; TOP: 2px
}
.menu_title2 {

}
.menu_title2 SPAN {
	FONT-WEIGHT: bold; LEFT: 8px; COLOR: #428eff; POSITION: relative; TOP: 2px
}
</STYLE>

<SCRIPT language=javascript1.2>
function showsubmenu(sid)
{
whichEl = eval("submenu" + sid);
if (whichEl.style.display == "none")
{
eval("submenu" + sid + ".style.display=\"\";");
}
else
{
eval("submenu" + sid + ".style.display=\"none\";");
}
}
</SCRIPT>

<META http-equiv=Content-Type content="text/html; charset=gb2312">
<META content="MSHTML 6.00.2900.2180" name=GENERATOR></HEAD>
<BODY leftMargin=0 topMargin=0 marginwidth="0" marginheight="0">
<TABLE cellSpacing=0 cellPadding=0 width="100%" align=left border=0>
  <TBODY>
  <TR>
    <TD vAlign=top bgColor=#799ae1>
      <TABLE cellSpacing=0 cellPadding=0 width=158 align=center>
        <TBODY>
        <TR>
          <TD vAlign=bottom height=42><IMG height=38
            src="left.files/title.gif" width=158> </TD></TR></TBODY></TABLE>
      <TABLE cellSpacing=0 cellPadding=0 width=158 align=center>
        <TBODY>
        <TR>
          <TD class=menu_title onMouseOver="this.className='menu_title2';"
          onmouseout="this.className='menu_title';" background=""
            height=25><SPAN><?php echo "��ӭ<font color=red>$arr[userid]</font>"; ?>

			| <A href="index.php?action=out"
            target=_parent><B>�˳�</B></A></SPAN></TD>
        </TR>
        <TR>
          <TD class=menu_title onMouseOver="this.className='menu_title2';"
          onmouseout="this.className='menu_title';" background=""
            height=25>&nbsp;</TD>
</TR>
        </TBODY></TABLE>
	  <TABLE cellSpacing=0 cellPadding=0 width=158 align=center>
        <TBODY>
        <TR>
          <TD class=menu_title id=menuTitle1
          onmouseover="this.className='menu_title2';" onclick=showsubmenu(0)
          onmouseout="this.className='menu_title';"
          background=left.files/admin_left_1.gif
            height=25><span><B>ϵͳ��������</B></span></TD>
        </TR>
        <TR>
          <TD id=submenu0>
            <DIV class=sec_menu style="WIDTH: 158px ">
            <TABLE cellSpacing=0 cellPadding=0 width=135 align=center>
              <TBODY>
              <TR>
                <TD height=20><A
                  href="sysconfig.php"
                  target=mainFrame>��վ��������</A></TD>
              </TR>
               <TR>

               <TR>
                 <TD height=20><a href="account.php" target="mainFrame">��̨�˻�����</a></TD>
               </TR>
               
               <TR>
                 <TD height=20><a href="member.php" target="mainFrame">��Ա�˻�����</a></TD>
               </TR>

              </TBODY></TABLE>




            </DIV>
            <DIV style="WIDTH: 158px">
            <TABLE cellSpacing=0 cellPadding=0 width=135 align=center>
              <TBODY>
              <TR>
                <TD height=20></TD></TR></TBODY></TABLE></DIV></TD></TR></TBODY></TABLE>



      <TABLE cellSpacing=0 cellPadding=0 width=158 align=center>
        <TBODY>
          <TR>
            <TD class=menu_title id=menuTitle1
          onmouseover="this.className='menu_title2';" onclick=showsubmenu(2)
          onmouseout="this.className='menu_title';"
          background=left.files/admin_left_2.gif height=25><SPAN>ϵͳ��������</SPAN> </TD>
          </TR>
          <TR>
            <TD id=submenu2><DIV class=sec_menu style="WIDTH: 158px">
                <TABLE cellSpacing=0 cellPadding=0 width=135 align=center>
                  <TBODY>

                  <TR>
                    <TD height=20><a href="areaconfig.php?name=province" target=mainFrame>ȫ����������</a></TD>
                  </TR>

                    <TR>
                    <TD height=20><a href="industry.php" target=mainFrame>��ҳ��ҵ����</a></TD>
                  </TR>


                  </TBODY>
                </TABLE>
            </DIV>
                <DIV style="WIDTH: 158px">
                  <TABLE cellSpacing=0 cellPadding=0 width=135 align=center>
                    <TBODY>
                      <TR>
                        <TD
      height=20></TD>
                      </TR>
                    </TBODY>
                  </TABLE>
                </DIV></TD>
          </TR>
        </TBODY>
      </TABLE>











    <TABLE cellSpacing=0 cellPadding=0 width=158 align=center>
        <TBODY>
          <TR>
            <TD class=menu_title id=menuTitle1
          onmouseover="this.className='menu_title2';" onclick=showsubmenu(2)
          onmouseout="this.className='menu_title';"
          background=left.files/admin_left_2.gif height=25><SPAN>ϵͳ���ݹ���</SPAN> </TD>
          </TR>
          <TR>
            <TD id=submenu2><DIV class=sec_menu style="WIDTH: 158px">
                <TABLE cellSpacing=0 cellPadding=0 width=135 align=center>
                  <TBODY>

                  <TR>
                    <TD height=20><a href="qyhy_edit.php" target=mainFrame>��ҵ��ҳ����</a></TD>
                  </TR>

                    <TR>
                    <TD height=20><a href="list_view.php" target=mainFrame>�����������</a></TD>
                  </TR>

				   <TR>
                    <TD height=20><a href="add_view.php" target=mainFrame>�����������</a></TD>
                  </TR>
				  
				  <TR>
                    <TD height=20><a href="list_special.php" target=mainFrame>�����ز�����</a></TD>
                  </TR>
				  
				  <TR>
                    <TD height=20><a href="add_special.php" target=mainFrame>�����ز����</a></TD>
                  </TR>


                  </TBODY>
                </TABLE>
            </DIV>
                <DIV style="WIDTH: 158px">
                  <TABLE cellSpacing=0 cellPadding=0 width=135 align=center>
                    <TBODY>
                      <TR>
                        <TD
      height=20></TD>
                      </TR>
                    </TBODY>
                  </TABLE>
                </DIV></TD>
          </TR>
        </TBODY>
      </TABLE>








    <TABLE cellSpacing=0 cellPadding=0 width=158 align=center>
        <TBODY>
          <TR>
            <TD class=menu_title id=menuTitle1
          onmouseover="this.className='menu_title2';" onclick=showsubmenu(2)
          onmouseout="this.className='menu_title';"
          background=left.files/admin_left_2.gif height=25><SPAN>��Ա���ݹ���</SPAN> </TD>
          </TR>
          <TR>
            <TD id=submenu2><DIV class=sec_menu style="WIDTH: 158px">
                <TABLE cellSpacing=0 cellPadding=0 width=135 align=center>
                  <TBODY>

                  <TR>
                    <TD height=20><a href="user_company.php" target=mainFrame>��ҵ��ҳ���</a></TD>
                  </TR>
				  
				  <TR>
                    <TD height=20><a href="list_keywords.php" target=mainFrame>վ����������</a></TD>
                  </TR>

                  


                  </TBODY>
                </TABLE>
            </DIV>
                <DIV style="WIDTH: 158px">
                  <TABLE cellSpacing=0 cellPadding=0 width=135 align=center>
                    <TBODY>
                      <TR>
                        <TD
      height=20></TD>
                      </TR>
                    </TBODY>
                  </TABLE>
                </DIV></TD>
          </TR>
        </TBODY>
      </TABLE>











	  <TABLE cellSpacing=0 cellPadding=0 width=158 align=center>
        <TBODY>
        <TR>
          <TD class=menu_title id=menuTitle1
          onmouseover="this.className='menu_title2';" onclick=showsubmenu(1)
          onmouseout="this.className='menu_title';"
          background=left.files/admin_left_2.gif height=25><SPAN>��վ�������</SPAN>
          </TD>
        </TR>
        <TR>
          <TD id=submenu1>
            <DIV class=sec_menu style="WIDTH: 158px">
            <TABLE cellSpacing=0 cellPadding=0 width=135 align=center>
              <TBODY>

              <TR>
                <TD height=20><a href="message.php" target="mainFrame">�ͻ����Թ���</a></TD>
              </TR>
              <TR>
                <TD height=20><a href="flink.php" target="mainFrame">�������ӹ���</a></TD>
              </TR>
              <TR>
                <TD height=20><a href="upfocus.php" target="mainFrame">��ҳͼƬ���</a></TD>
              </TR>
              <TR>
                <TD height=20><a href="ad.php" target="mainFrame">��վ������</a></TD>
              </TR>
              
              <TR>
                <TD height=20><a href="sitemapmake.php" target="mainFrame">ȫվ����sitemap</a></TD>
              </TR>
              </TBODY></TABLE>
            </DIV>
            <DIV style="WIDTH: 158px">
            <TABLE cellSpacing=0 cellPadding=0 width=135 align=center>
              <TBODY>
              <TR>
                <TD
      height=20></TD></TR></TBODY></TABLE></DIV></TD></TR></TBODY></TABLE>




      <TABLE cellSpacing=0 cellPadding=0 width=158 align=center>
        <TBODY>
        <TR>
          <TD class=menu_title id=menuTitle1
          onmouseover="this.className='menu_title2';"
          onmouseout="this.className='menu_title';"
          background=left.files/admin_left_9.gif
          height=25><SPAN>��վ��̨����ϵͳ</SPAN></TD>
        </TR>
        <TR>
          <TD>
            <DIV class=sec_menu style="WIDTH: 158px">
            <TABLE cellSpacing=0 cellPadding=0 width=135 align=center>
              <TBODY>
              <TR>
                <TD height=20 bgcolor="#D6DFF7" style="LINE-HEIGHT: 150%">��Ȩ:�����Ƽ�
                 </TD>
				</TR>
				 <TR>
                <TD height=20 bgcolor="#D6DFF7" style="LINE-HEIGHT: 150%">��ϵ:QQ 88888888
                 </TD>
				</TR>
                <TR>
                <TD height=20 bgcolor="#D6DFF7" style="LINE-HEIGHT: 150%">��ַ:<a  target="_blank" href="http://www.erlitech.com/">www.erlitech.com</a>
                 </TD>
				</TR>

				 </TBODY></TABLE></DIV></TD></TR></TBODY></TABLE></TR></TBODY></TABLE>


				  </BODY></HTML>
